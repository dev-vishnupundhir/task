<?php
namespace App\Model\Table;

use Cake\ORM\Table;

use Cake\Validation\Validator;

use Cake\ORM\TableRegistry;

use Cake\Mailer\Email;

use Cake\ORM\Query;
 

class ReportUsersTable extends Table
{ 
    
     public function initialize(array $config)
    {
        $this->addAssociations([
            'belongsTo' => [
                'Users' => [
                    'className' => 'Users',
                    'foreignKey' => 'report_by',
                    'propertyName' => 'ReportBy'
                ],
                'ReportTo' => [
                    'className' => 'Users',
                    'foreignKey' => 'report_to',
                    'propertyName' => 'ReportTo'
                ],
            ]
        ]);
    }
}
?>