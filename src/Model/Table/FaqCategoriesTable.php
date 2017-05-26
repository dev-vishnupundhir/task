<?php
namespace App\Model\Table;

use Cake\ORM\Table;

use Cake\Validation\Validator;

use Cake\ORM\TableRegistry;

use Cake\Mailer\Email;

use Cake\ORM\Query;
 

class FaqCategoriesTable extends Table
{
    public function getActiveData()
    {
        $getActiveData = $this->find()
        ->where(['status'=>"Active"])
        ->hydrate(false)
        ->toArray();
        return $getActiveData;
    }
    public function saveFaqCategorie($data = null)
    {
        if(!empty($data)) {           
            $info = $this->newEntity($data);
            if($this->save($info)) {
                return "success";
            }
        }
    }
    public function getFaqCategory($id = null)
    {   
        if(!empty($id)) {
            $user_info = $this->find()
            ->where(['id'=>$id])
            ->hydrate(false)
            ->first();
            return $user_info;
        }
    }
    public function editFaq($data = null)
    {
        if (!empty($data)) {
            $data['FaqCategories']['id'] = $data['FaqCategories']['id'];
            $FaqCategoryInfo = $this->newEntity($data);
            if($this->save($FaqCategoryInfo)) {
                return "success";
            }
        }
    } 
}?>