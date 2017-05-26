<?php
namespace App\Model\Table;

use Cake\ORM\Table;

use Cake\Validation\Validator;

use Cake\ORM\TableRegistry;

use Cake\Mailer\Email;

use Cake\ORM\Query;
 

class ChatThreadsTable extends Table
{ 
    
    public function initialize(array $config)
    {
        $this->addAssociations([
            'belongsTo' => [
                'Sender' => [
                    'className' => 'Users',
                    'foreignKey' => 'sender_id',
                    'propertyName' => 'Sender'
                ],
                'Reciever' => [
                    'className' => 'Users',
                    'foreignKey' => 'reciever_id',
                    'propertyName' => 'Reciever'
                ]
            ]
        ]);
    }
}
?>