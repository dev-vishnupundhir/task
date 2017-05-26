<?php 
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

use Cake\ORM\TableRegistry;

use Cake\Mailer\Email;

use Cake\ORM\Query;

class CountriesTable extends Table
{ 
    
    public function activeCountry()
    {
        $getActiveCountry = $this->find()
        ->where(['status'=>"Active"])
        ->hydrate(false)
        ->toArray();
        return $getActiveCountry;
    }
   

}
?>