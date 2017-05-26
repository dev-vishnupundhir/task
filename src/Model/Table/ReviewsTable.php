<?php
namespace App\Model\Table;

use Cake\ORM\Table;

use Cake\Validation\Validator;

use Cake\ORM\TableRegistry;

use Cake\Mailer\Email;

use Cake\ORM\Query;
 

class ReviewsTable extends Table
{ 
    
     public function initialize(array $config)
    {
        $this->addAssociations([
            'belongsTo' => [
                'Users' => [
                    'className' => 'Users',
                    'foreignKey' => 'user_id',
                    'propertyName' => 'UserName'
                ],
                'RatedUser' => [
                    'className' => 'Users',
                    'foreignKey' => 'user_rating_id',
                    'propertyName' => 'RatedUser'
                ],
            ]
        ]);
    }
}
?>