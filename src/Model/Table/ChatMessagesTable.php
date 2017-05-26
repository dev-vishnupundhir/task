<?php
namespace App\Model\Table;

use Cake\ORM\Table;

use Cake\Validation\Validator;

use Cake\ORM\TableRegistry;

use Cake\Mailer\Email;

use Cake\ORM\Query;
 

class ChatMessagesTable extends Table
{ 
    
     public function initialize(array $config)
    {
        $this->addAssociations([
            'belongsTo' => [
                'Users' => [
                    'className' => 'Users',
                    'foreignKey' => 'sender_id',
                    'propertyName' => 'Sender'
                ],
                'Reciver' => [
                    'className' => 'Users',
                    'foreignKey' => 'reciever_id',
                    'propertyName' => 'Reciver'
                ],
            ]
        ]);
    }
}
?>