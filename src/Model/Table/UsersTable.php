<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\validation\validator;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\ORM\Query;
class UsersTable extends Table 
{
    public function initialize(array $config)
    {
        $this->addAssociations([
            'belongsTo'=> [
                'States'=> [
                    'propertyName'=>'States'
                ],
                'Cities'=> [
                    'propertyName'=>'Cities'
                ],
                'Countries'=> [
                    'propertyName'=>'Countries'
                ],
                'Reviews'=>[
                    'propertyName'=>'Reviews'
                ]
            ],
            'hasOne'=> [
                'UserProfiles'=> [
                    'propertyName'=>'UserProfiles'
                ]
            ],
            'hasMany'=> [
                'UserPictures'=> [
                    'propertyName'=>'UserPictures'
                ]
            ]
        ]);
    }

    function userReg($data = null)
    {
        if(!empty($data)) {
            $data['Users']['email'] = trim($data['Users']['email']);
            $data['Users']['decode_password'] = $data['Users']['password'];
            $data['Users']['user_type'] = "user";
            $userInfo = $this->newEntity($data);
            if($this->save($userInfo)) {
                $id = $userInfo->id;
                $uid = base64_encode(convert_uuencode($id));
                $email = sha1($data['Users']['email']);
                $this->userRegMail($uid,$email,$data);
                return $id;
            }
        }
    }

    function userRegMail($uid = null, $email = null,$data = null) 
    {
        $template = TableRegistry::get('EmailTemplates');
        $queryInfo = $template
        ->find()
        ->where(array(
                'id' =>'6'
            )
        ); 
        // $token = base64_encode(convert_uuencode(time())); 
        $link = '<a href="'.HTTP_ROOT.'home/verify_email/'.$uid.'/'.$email.'">Click Here</a>';               
        $templateInfo = $queryInfo->first();
        $emailContent = $templateInfo['html_content'];
        $emailContent = str_replace('{username}',$data['Users']['user_name'], $emailContent);
        $emailContent = str_replace('{link}',$link, $emailContent);
        $email = new Email();
        $email->viewVars(['emailContent' => $emailContent]);
        // prx($emailContent);
        $email->template('common_template','default')
            ->emailFormat('html')
            ->to($data['Users']['email'])
            ->from($templateInfo['from_email'],$templateInfo['from_name'])
            ->subject($templateInfo['subject'])
            ->send();
    }

    function forgotPass($data = null)
    {
        if(!empty($data)) {
            $user_info = $this->find()
            ->where(['email'=>$data['Users']['email']])
            ->hydrate(false)
            ->first();
            if(isset($user_info) && !empty($user_info)) {   
                $this->sendForgotPasswordEmailLink($user_info);
                return 'success';
            } else {
                return 'failure';
            }   
        }
    }

    function sendForgotPasswordEmailLink($info) 
    {   
       
        $uid = base64_encode(convert_uuencode($info['id']));
        $email = sha1($info['email']);
        $template = TableRegistry::get('EmailTemplates');
        $queryInfo = $template
        ->find()
        ->where(array(
                'id' =>'7'
            )
        ); 
        $token = base64_encode(convert_uuencode(time()));     
        $root = HTTP_ROOT.'home/resetPassword/'.$uid.'/'.$email.'/'.$token;
        $temp1['Users']['id'] = $info['id'];
        $temp1['Users']['activation_key'] = $token;
        $userinfo = $this->newEntity($temp1);
        $this->save($userinfo);       
        $resetPasswordLink = '<a href="'.$root.'">Click here to reset password</a>';            
        $templateInfo = $queryInfo->first();
        $emailContent = $templateInfo['html_content'];
        $emailContent = str_replace('{username}',$info['user_name'], $emailContent);
        $emailContent = str_replace('{link}',$resetPasswordLink, $emailContent);
        // $emailContent = str_replace('{email}',$info['email'], $emailContent);
        $email = new Email();
        $email->viewVars(['emailContent' => $emailContent]);
        $email->template('common_template','default')
            ->emailFormat('html')
            ->to($info['email'])
            ->from($templateInfo['from_email'],$templateInfo['from_name'])
            ->subject($templateInfo['subject'])
            // prx($emailContent);
            ->send();
    }

    function resetPass($data = null)
    {
        if(!empty($data)) {
            $data['Users']['id'] = $data['Users']['id'];
            $data['Users']['password'] = $data['Users']['password'];
            $data['Users']['decode_password'] = $data['Users']['password'];
            $data['Users']['activation_key'] = " ";
            $userInfo = $this->newEntity($data);
            $this->save($userInfo);   
        }
    }
    public function editData($data = null)
    {
        if(!empty($data)){
            unset($data['image']);
            $data['Users']['id'] = $data['Users']['id'];
             $user_info1 = $this->newEntity($data);
                if($this->save($user_info1)){
                    return "success";
                } 
        }
    }
}
?>