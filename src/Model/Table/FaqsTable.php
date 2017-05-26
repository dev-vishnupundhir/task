<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

use Cake\ORM\TableRegistry;

use Cake\Mailer\Email;

use Cake\ORM\Query;
 

class FaqsTable extends Table
{ 
    public function initialize(array $config)
    {
        $this->addAssociations([
            'belongsTo'=>
            [
                'FaqCategories'=>
                [
                    'propertyName'=>'FaqCategories'
                ]
            ]
        ]);
    }
    function faqs($data = null)
    {
        if(!empty($data)){
        	           
            $info = $this->newEntity($data);
            if($this->save($info)){
                return "success";
            }
        }      
    }

    function faqInfo($id = null)
    {   
        $user_info = $this->find()
        ->where(['Faqs.id'=>$id])
        ->hydrate(false)
        ->first();
        return $user_info;
    }    
    public function getActiveFaq()
    {
        $getActiveData = $this->find()
        ->where(['status'=>"Active"])
        ->hydrate(false)
        ->toArray();
        return $getActiveData;
    }
    public function getActiveFaqs($id = null)
    {
        $getActiveData = $this->find()
        ->where(['status'=>"Active",'faq_category_id'=>$id])
        ->hydrate(false)
        ->toArray();
        return $getActiveData;
    }

}
?>