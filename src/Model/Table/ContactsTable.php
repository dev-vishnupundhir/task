<?php
namespace App\Model\Table;

use Cake\ORM\Table;

use Cake\Validation\Validator;

use Cake\ORM\TableRegistry;

use Cake\Mailer\Email;

use Cake\ORM\Query;
 

class ContactsTable extends Table
{ 
	

    function messageInfo($id = null)
    {   
        $user_info = $this->find()
        ->where(['Contacts.id'=>$id])
        ->hydrate(false)
        ->first();

        return $user_info;
    }
    
    function savemessage($data = null)
    {
        if(!empty($data)){
           
            $info = $this->newEntity($data);
            if($this->save($info)){
               $postId = $info->id;
                $this->sendContactUsReplyEmail($postId);
               return $postId;
            }
        }      
    }

    function savemessagefront($data = null)
    {
        if(!empty($data)){
           
            $info = $this->newEntity($data);
            if($this->save($info)){
               return 'success';
            }
        }      
    }

    public function sendContactUsReplyEmail($postId)
    {
       
        if (!empty($postId)) {
           $template = TableRegistry::get('EmailTemplates'); 
            $emailTemp = $template->find()
            ->where(array(
                    'id' =>'9',
                )
            );
            $templateInfo = $emailTemp->first()->toArray(); 

            $memInfo = $this->find()
                ->where(array(
                        'id' =>$postId,
                    )
                ); 
            $info = $memInfo->first()->toArray(); 
            $emailContent = $templateInfo['html_content'];
            $emailContent = str_replace('../../../', HTTP_ROOT, $emailContent);
            $email        = new Email('default');
            $email->template('common_template','default');
            $email->emailFormat('html');
            $emailContent = str_replace('{[user_name]}', $info['user_name'], $emailContent);
            $emailContent = str_replace('{[user_email]}', $info['email_id'], $emailContent);
            $emailContent = str_replace('{[admin_reply]}', $info['admin_reply'], $emailContent);
            $email->viewVars(array(
                'imgPath' => NULL,
                'emailContent' => $emailContent
            ));
            
             $admin = TableRegistry::get('Admins');
            $adminInfo = $admin->find()
                ->where(array(
                        'id' =>1,
                    )
                );
            $adinfo = $adminInfo->first()->toArray();
                    $email->to(trim($info['email_id']));
                    $email->from($templateInfo['from_email']);
            $email->subject($templateInfo['subject']);
            $email->send();
            
        }
    }

}
?>