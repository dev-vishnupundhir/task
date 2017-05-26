<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\validation\validator;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\ORM\Query;
class MembershipPlansTable extends Table 
{
    public function initialize(array $config)
    {
        $this->addAssociations([
            
            'hasMany'=> [
                'MembershipPlansServices'=> [
                    'propertyName'=>'MembershipPlansServices'
                ]
            ]
        ]);
    }

    
}
?>