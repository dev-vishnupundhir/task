<?php

namespace App\Model\Table;

use Cake\ORM\Table;

use Cake\Validation\Validator;

use Cake\ORM\TableRegistry;

use Cake\Mailer\Email;


class AdminsTable extends Table
{
	function adminInfo($id = null,$data = null)
	{
		$query = $this->find();
        if(!empty($id) && !empty($data)){
        	$data['Admins']['id'] = $id;
        	$adminInfo = $this->newEntity($data);
        	$this->save($adminInfo);
        	$query->first()->toArray();
        }
	    return $query->first()->toArray();
	}

	function changepass($id = null,$data = null)
	{
		
        if(!empty($id) && !empty($data)){
        	$info['Admins']['id'] = $id;
            $password = md5($data['Admins']['password']); 
        	$info['Admins']['password'] = $password;
        	$info['Admins']['decode_password'] = $data['Admins']['password'];
        	$adminInfo = $this->newEntity($info); 
        	$this->save($adminInfo);
        	
        }
    }

    function unlinkImage($id = null)
    {
    	if(!empty($id)){
    		$picInfo = $this->find()
    		->where(['id' => $id])
    		->select(['image'])
    		->hydrate(false)
    		->first();
    		$path = realpath('../webroot/img/profilePic').'/'.$picInfo['image'];
    		unlink($path);
    	}
    }

    function forgotPass($data = null)
    {
 
    	if(!empty($data)){
    		$user_info = $this->find()
    		->where(['email'=>$data['Admins']['email']])
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
        $template = TableRegistry::get('EmailTemplates');
        $queryInfo = $template
        ->find()
        ->where(array(
                'id' =>'1'
            )
        ); 
        $token = base64_encode(convert_uuencode(time()));     
        $root = HTTP_ROOT.'admin/users/resetPassword/'.$token;
        $temp1['Admins']['id'] = $info['id'];
        $temp1['Admins']['activation_key'] = $token;
        $admininfo = $this->newEntity($temp1);
        $this->save($admininfo);       
        $resetPasswordLink = '<a href="'.$root.'">Click here to reset password</a>';            
        $templateInfo = $queryInfo->first();
        $emailContent = $templateInfo['html_content'];
        $emailContent = str_replace('{name}',$info['firstname'] . $info['lastname'], $emailContent);
        $emailContent = str_replace('{link}',$resetPasswordLink, $emailContent);
        $emailContent = str_replace('{email}',$info['email'], $emailContent);
        $email = new Email();
        $email->viewVars(['emailContent' => $emailContent]);
        $email->template('common_template','default')
            ->emailFormat('html')
            ->to($info['email'])
            ->from($templateInfo['from_email'],$templateInfo['from_name'])
            ->subject($templateInfo['subject'])
            ->send();
    }

    function resetPass($data = null)
	{
		
        if(!empty($data)){
        	$info['Admins']['id'] = 1;
            $password = md5($data['Admins']['password']); 
        	$info['Admins']['password'] = $password;
        	$info['Admins']['decode_password'] = $data['Admins']['password'];
        	$info['Admins']['activation_key'] = " ";
        	$adminInfo = $this->newEntity($info);
        	$this->save($adminInfo);
        	
        }
    }

    

    
}