<?php 
namespace App\Controller;
use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Cache\Cache;
use Cake\Mailer\Email;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\Time;
use Cake\ORM\Query;
use Cake\Validation\Validator;
use App\Controller\ValidationController;

ob_start();
class MembersController extends AppController
{   
    public function beforeFilter(Event $event)
    {
        
        $this->Auth->allow(['checkStatus','voiceCalling','rateUserProfile']);
    }

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Auth', [
            'loginAction' => [
                'controller' => 'home',
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
    
    public function userDashboard($element = null)
    {
        $this->set('title','Friendoz | User Dashboard');
        $this->viewBuilder()->layout('public_dashboard');
        $this->loadModel('Users');
        $this->loadModel('Countries');
        $userId = $this->request->Session()->read('Auth.User.id');
        $userInfo = $this->Users->find()
            ->contain(['Countries','States','Cities'])
            ->where(['Users.id' => $userId])
            ->hydrate(false)
            ->first();
        $countryInfo = $this->Countries->activeCountry();
        $this->set(compact('userInfo','countryInfo'));
        if($this->request->is('post')) {
            $data = $this->request->data;
            $user_id = $this->request->session()->read('Auth.User.id');
            if(!empty($data)) {
                if($data['Users']['section'] == "about") {
                    $info['Users']['id'] = $user_id;
                    $info['Users']['description'] = $data['Users']['about'];
                    $user_info1 = $this->Users->newEntity($info);
                    $this->Users->save($user_info1);                 
                    $this->Flash->info('Profile Updated Successfully');
                    $this->redirect(HTTP_ROOT.'members/userDashboard');
                } elseif($data['Users']['section'] == "persnal") {
                    $info['Users']['id'] = $user_id;
                    $info['Users']['first_name'] = $data['Users']['first_name'];
                    $info['Users']['last_name'] = $data['Users']['last_name'];
                    $info['Users']['user_name'] = $data['Users']['user_name'];
                    $info['Users']['socal_status'] = $data['Users']['socal_status'];
                    $info['Users']['search_criteria'] = $data['Users']['search_criteria'];
                    $info['Users']['gender'] = $data['Users']['gender'];
                    $user_info1 = $this->Users->newEntity($info);
                    $this->Users->save($user_info1);  
                    $this->request->session()->write('Auth.User.user_name',$info['Users']['user_name']);               
                    $this->Flash->info('Profile Updated Successfully');
                    $this->redirect(HTTP_ROOT.'members/userDashboard');
                } elseif($data['Users']['section'] == "contact") {
                    $info['Users']['id'] = $user_id;
                    $info['Users']['phone'] = $data['Users']['phone'];
                    $info['Users']['address'] = $data['Users']['address'];
                    $info['Users']['age'] = $data['Users']['age'];
                    $user_info1 = $this->Users->newEntity($info);
                    $this->Users->save($user_info1);                 
                    $this->Flash->info('Profile Updated Successfully');
                    $this->redirect(HTTP_ROOT.'members/userDashboard');  
                } elseif($data['Users']['section'] == "interest") {
                    $info['Users']['id'] = $user_id;
                    $info['Users']['language'] = $data['Users']['language'];
                    $info['Users']['interest'] = $data['Users']['interest'];
                    $info['Users']['country_id'] = $data['Users']['country_id'];
                    $info['Users']['state_id'] = $data['Users']['state_id'];
                    $info['Users']['city_id'] = $data['Users']['city_id'];
                    $user_info1 = $this->Users->newEntity($info);
                    $this->Users->save($user_info1);                 
                    $this->Flash->info('Profile Updated Successfully');
                    $this->redirect(HTTP_ROOT.'members/userDashboard');  
                } elseif($data['Users']['section'] == "change-pass") {
                    $info2['Users']['id'] = $user_id;
                    $info2['Users']['password'] = $data['Users']['password'];
                    $info2['Users']['decode_password'] = $data['Users']['password'];
                    $userInfo = $this->Users->newEntity($info2);
                    $this->Users->save($userInfo);      
                    $this->Flash->info('Password Change Successfully');
                    $this->redirect(HTTP_ROOT.'members/userDashboard');  
                } 
            }
        }
        if($this->request->is('ajax')) {
            if($element == "upload-pic") {
                $this->viewBuilder()->layout('ajax');
                $this->render('/Element/frnt/member/upload_pic');
            } elseif($element == "dashboard-contant") {
                $this->viewBuilder()->layout('ajax');
                $this->render('/Element/frnt/member/dashboard_content');
            } elseif($element == "galary") {
                $this->viewBuilder()->layout('ajax');
                $userGalary = $this->Users->find()
                    ->contain(['UserPictures'=>function($q) {
                        return $q->select(['id','image','user_id']);
                    }])
                    ->where(['Users.id' => $userId])
                    ->select(['Users.id'])
                    ->hydrate(false)
                    ->first();
                $this->set(compact('userGalary'));
                $this->render('/Element/frnt/member/user_galary');
            }  elseif($element == "settings") {
                $this->viewBuilder()->layout('ajax');
                $this->render('/Element/frnt/member/change_password');
            }
        }
    }

    public function changeProfilePic()
    {
        $this->loadModel('Users');
        $userId = $this->request->session()->read('Auth.User.id');
        $data = $this->request->data;
        if(!empty($data['edt-prof']['name'])) {
            $logo = $data['edt-prof']['name'];
            $ext = explode('.', $logo);
            if($ext[1] == 'png' || $ext[1] == 'jpg' || $ext[1] == 'jpeg') {
                $logo = $this->Utility->sanitizeFilename($logo);
                $logo = $this->Utility->randomString() . '-' . $logo;
                $sourcePath = $data['edt-prof']['tmp_name'];  // Storing source path of the file in a variable
                $targetPath = '../webroot/img/profilePic/'.$logo; // Target path where file is to be stored
                if(is_uploaded_file($sourcePath)) {
                    $this->Resize->resize($sourcePath,$targetPath,'aspect_fit',250,250, 0, 0, 0, 0 );
                    $userPic = $this->Users->find()
                                ->select(['id','image'])
                                ->where(['id'=>$userId])
                                ->hydrate('false')
                                ->first();
                    if(file_exists('../webroot/img/profilePic/'.$userPic['image'])) {
                        unlink('../webroot/img/profilePic/'.$userPic['image']);
                    }
                    $info['Users']['id'] = $userId;
                    $info['Users']['image'] = $logo; 
                    $this->request->session()->write('Auth.User.image',$info['Users']['image']);
                    $user_info1 = $this->Users->newEntity($info);
                    $this->Users->save($user_info1);
                    echo HTTP_ROOT.'img/profilePic/'.$logo;
                    die;  
                }
            } 
        }
    }

    public function ChangeCoverPic()
    {
        $this->loadModel('Users');
        $userId = $this->request->session()->read('Auth.User.id');
        $data = $this->request->data;
        if(!empty($data['edt-cover']['name'])) {
            $logo = $data['edt-cover']['name'];
            $ext = explode('.', $logo);
            if($ext[1] == 'png' || $ext[1] == 'jpg' || $ext[1] == 'jpeg') {
                $logo = $this->Utility->sanitizeFilename($logo);
                $logo = $this->Utility->randomString() . '-' . $logo;
                $sourcePath = $data['edt-cover']['tmp_name'];  // Storing source path of the file in a variable
                $targetPath = '../webroot/img/coverPic/'.$logo; // Target path where file is to be stored
                if(is_uploaded_file($sourcePath)) {
                    // $this->Resize->resize($sourcePath,$targetPath,'as_define',1250,247, 0, 0, 0, 0 );
                    move_uploaded_file($sourcePath, $targetPath);
                    $userPic = $this->Users->find()
                                ->select(['id','cover_pic'])
                                ->where(['id'=>$userId])
                                ->hydrate('false')
                                ->first();
                    if(file_exists('../webroot/img/coverPic/'.$userPic['cover_pic'])) {
                        unlink('../webroot/img/coverPic/'.$userPic['cover_pic']);
                    }
                    $info['Users']['id'] = $userId;
                    $info['Users']['cover_pic'] = $logo; 
                    $user_info1 = $this->Users->newEntity($info);
                    $this->Users->save($user_info1);
                    echo "success";
                    die;   
                }
            } 
        }
    }

    public function uploadGalary()
    {
        $this->loadModel('UserPictures');
        $userId = $this->request->session()->read('Auth.User.id');
        $data = $this->request->data;
        if(!empty($data['upld-gal']['name'])) {
            $logo = $data['upld-gal']['name'];
            $ext = explode('.', $logo);
            if($ext[1] == 'png' || $ext[1] == 'jpg' || $ext[1] == 'jpeg') {
                $logo = $this->Utility->sanitizeFilename($logo);
                $logo = $this->Utility->randomString() . '-' . $logo;
                $sourcePath = $data['upld-gal']['tmp_name'];  // Storing source path of the file in a variable
                $targetPath = '../webroot/img/uploadGalary/'.$logo; // Target path where file is to be stored
                 $targetPath1 = '../webroot/img/uploadGalary/main/'.$logo;
                if(is_uploaded_file($sourcePath)) {
                    $this->Resize->resize($sourcePath,$targetPath1,'aspect_fill',500,400, 0, 0, 0, 0 );
                    $this->Resize->resize($sourcePath,$targetPath,'aspect_fill',350,350, 0, 0, 0, 0 );
                    $info['UserPictures']['user_id'] = $userId; 
                    $info['UserPictures']['image'] = $logo; 
                    $user_info1 = $this->UserPictures->newEntity($info);
                    if($this->UserPictures->save($user_info1)) {
                        echo $user_info1->id;
                        die;
                    }
                }
            } 
        }
    }

    public function deleteGalaryPicture()
    {
        $this->loadModel('UserPictures');
        if($this->request->is('ajax')) {
            $data = $this->request->data;
            if(!empty($data['userPicId'])) {
                $imgName = $this->UserPictures->find()
                ->where(['id'=>$data['userPicId']])
                ->select(['image'])
                ->hydrate(false)
                ->first();
            if(file_exists('../webroot/img/uploadGalary/'.$imgName['image'])) {
                unlink('../webroot/img/uploadGalary/'.$imgName['image']);
                unlink('../webroot/img/uploadGalary/main/'.$imgName['image']);
            }
                $entity = $this->UserPictures->get($data['userPicId']);
                if($result = $this->UserPictures->delete($entity)) {
                    echo "success";
                    die;
                }
            }
        }
    }

    public function checkStatus()
    {
        if($this->request->is('ajax')) {
            $this->loadModel('Users');
            if($this->request->session()->read('Auth.User.id')) {
                $userId = $this->request->session()->read('Auth.User.id');
                $loginTime = date('Y-m-d H:i:s');
                $query = $this->Users->query();
                $result = $query->update()
                        ->set(['login_update_time' => $loginTime,'login_status'=>1])
                        ->where(['id' => $userId])
                        ->execute();
                echo "Success";
                die;
            } else {
                echo "not login";
                die;
            }
        }
    }

    public function planPayment($id = null)
    {
        $this->viewBuilder()->layout("public");
        $this->set('title','Friendoz | Plan Payment');
        $this->loadModel('MembershipPlans');
        $this->loadModel('MembershipPayments');
        $this->loadModel('UserPlans');
        $planId = $this->Utility->decode($id);
        $userId = $this->request->session()->read('Auth.User.id');
        if(!empty($planId) && $planId == 1) {
            $planInfo = $this->MembershipPlans->find()
                ->contain(['MembershipPlansServices'])
                ->where(['MembershipPlans.id'=>$planId])
                ->hydrate(false)
                ->first();
            $info['MembershipPayments']['user_id'] = $userId;
            $info['MembershipPayments']['membership_plan_id'] = $planId;
            $info['MembershipPayments']['plan_amount'] = $planInfo['price'];
            $info['MembershipPayments']['amount_pay'] = $planInfo['price'];
            $info['MembershipPayments']['plan_type'] = $planInfo['name'];
            $info['MembershipPayments']['payment_date'] = date('Y-m-d H:i:s');
            $info['MembershipPayments']['payment_status'] = 'Active';
            $paymentInfo = $this->MembershipPayments->newEntity($info);
            if($this->MembershipPayments->save($paymentInfo)) {
                $membershipPaymentId = $paymentInfo->id;
                $planExpireDate = date('Y-m-d H:i:s',strtotime("+30 days"));
                $info1['UserPlans']['user_id'] = $userId;
                $info1['UserPlans']['membership_payment_id'] = $membershipPaymentId;
                $info1['UserPlans']['membership_plan_id'] = $planId;
                $info1['UserPlans']['plan_amount'] = $planInfo['price'];
                $info1['UserPlans']['plan_type'] = $planInfo['name'];
                $info1['UserPlans']['plan_date'] = date('Y-m-d H:i:s');
                $info1['UserPlans']['plan_expire_date'] = $planExpireDate;
                $info1['UserPlans']['plan_status'] = 'Active';
                $userPlanInfo = $this->UserPlans->newEntity($info1);
                if($this->UserPlans->save($userPlanInfo)) {
                    $this->Flash->info('Your basic Plan is Activate Now you can use the Service of the Basic Plan');
                    $this->redirect(HTTP_ROOT.'home/');  
                }
            } 
        } else {
            $planInfo = $this->MembershipPlans->find()
                ->contain(['MembershipPlansServices'])
                ->where(['MembershipPlans.id'=>$planId])
                ->hydrate(false)
                ->first();
            $this->set(compact('planInfo'));
        }
    }
    
    public function sendMessage($u_id = null)
    {
        $this->set('title','Friendoz | Send Meassage');
        $this->viewBuilder()->layout('public');
        $u_id = $this->Utility->decode($u_id);
        $this->loadModel('Users');
        $this->loadModel('Countries');
        $this->loadModel('States');
        $this->loadModel('Cities');
        $this->loadModel('UserLikes');
        $this->loadModel('UsersDislikes');
        $this->loadModel('ChatMessages');
        $this->loadModel('ChatThreads');
        $userId = $this->request->Session()->read('Auth.User.id');//for login user id
        $login_user_info = $this->Users->find()
                ->where(['Users.id'=>$userId])
                ->hydrate(false)
                ->first(); 
        $this->set(compact('login_user_info')); 
        
        $userInfo = $this->Users->find()
                ->contain(['Countries','States','Cities'])
                ->where(['Users.id'=>$u_id])
                ->hydrate(false)
                ->first(); 
        $this->set(compact('userInfo'));//prx($userInfo);
        $reciever_id = $u_id;
        
        $thread_info = $this->ChatThreads->find()
                    ->where(['ChatThreads.sender_id'=>$userId,'ChatThreads.reciever_id'=>$reciever_id])
                    ->orWhere(['ChatThreads.reciever_id'=>$userId,'ChatThreads.sender_id'=>$reciever_id])
                    ->hydrate(false)
                    ->first();
    
        $thread_id = $thread_info['id']; 
        $this->set(compact('thread_info'));
        $chat_message = $this->ChatMessages->find()
            ->contain(['Users'=>['fields'=>['id','image','user_name']],'Reciver'=>['fields'=>['id','image','user_name']]])
            ->where(['chat_thread_id'=>$thread_id])
            ->hydrate(false)
            ->toArray();
         
        $this->set(compact('chat_message'));
        $unread_msg = $chat_message;
        $this->loadModel('UserLikes');
        $likesUser = $this->UserLikes->find('list',['valueField'=>'liked_user_id'])
            ->where(['user_id'=>$userId,'liked_user_id'=>$u_id])
            ->hydrate(false)
            ->first(); //prx($likesUser);
        $this->set(compact('likesUser'));
    
        $this->loadModel('UserDislikes');
        $dislikesUser = $this->UserDislikes->find('list',['valueField'=>'dislike_user_id'])
            ->where(['user_id'=>$userId,'dislike_user_id'=>$u_id])
            ->hydrate(false)
            ->first();
        $this->set(compact('dislikesUser'));
        /* find this user report or not */
        $this->loadModel('reportUsers');
        $reportUserCount = $this->reportUsers->find()
                            ->where(['report_by'=>$userId,'report_to'=>$u_id])
                            ->hydrate(false)
                            ->count();
        $this->set(compact('reportUserCount'));
        /* end find this user report or not */
    }
    
    public function chatmessage()
    {
        if ($this->request->is('ajax')) {
            $data = $this->request->data; 
            $reciever_id = $data['reciever_id']; 
            $msg = $data['msg'];
            $this->loadModel('ChatMessages');
            $this->loadModel('ChatThreads');
            $userId = $this->request->Session()->read('Auth.User.id');
            
            $chat_thread_info = $this->ChatThreads->find()
                    ->where(['ChatThreads.sender_id'=>$userId,'ChatThreads.reciever_id'=>$reciever_id])
                    ->orWhere(['ChatThreads.reciever_id'=>$userId,'ChatThreads.sender_id'=>$reciever_id])
                    ->hydrate(false)
                    ->first();
            if (empty($chat_thread_info)) {
                
                $info['ChatThreads']['sender_id'] = $userId;
                $info['ChatThreads']['reciever_id'] = $reciever_id;
                $info['ChatThreads']['date'] = date('Y-m-d H:i');
                $save_info = $this->ChatThreads->newEntity($info);
                if ($this->ChatThreads->save($save_info)) {
                    $chat_thred_id = $save_info->id;
                   
                    $chat_msg['ChatMessages']['chat_thread_id'] = $chat_thred_id;
                    $chat_msg['ChatMessages']['sender_id'] = $userId;
                    $chat_msg['ChatMessages']['reciever_id'] = $reciever_id;
                    $chat_msg['ChatMessages']['message'] = $msg;
                    $chat_msg['ChatMessages']['msg_time'] = date('H:i');
                    $chat_info = $this->ChatMessages->newEntity($chat_msg);
                    if($this->ChatMessages->save($chat_info)) {
                        echo 1;
                        die;
                    }
                }
    
            } elseif (!empty($chat_thread_info)) {
    
                $chat_thred_id = $chat_thread_info['id'];  
                
                $chat_msg['ChatMessages']['chat_thread_id'] = $chat_thred_id;
                $chat_msg['ChatMessages']['sender_id'] = $userId;
                $chat_msg['ChatMessages']['reciever_id'] = $reciever_id;
                $chat_msg['ChatMessages']['message'] = $msg;
                $chat_msg['ChatMessages']['msg_time'] = date('H:i');
                $chat_info = $this->ChatMessages->newEntity($chat_msg);
                if($this->ChatMessages->save($chat_info)){
                    echo 2;
                    die;
                }
    
            }
        }
    }
    
    public function latestMsg()
    {
        if ($this->request->is('ajax')) {
            $data = $this->request->data; 
    
            $user_id = $data['sender_id'];
            $reciever_id = $data['reciever_id'];
            $thread_id = $data['thread_id'];
            $this->loadModel('ChatMessages');
            
            $chat_message = $this->ChatMessages->find()
                ->where(['chat_thread_id'=>$thread_id,'soft_status'=>'Unread','sender_id'=>$reciever_id])
                ->order(['ChatMessages.id'=>'DESC'])
                ->hydrate(false)
                ->toArray();
            //$this->set(compact('chat_message'));
            $this->loadModel('Users');
            $user_info = $this->Users->find()
                ->select(['id','user_name','image'])
                ->where(['Users.id'=>$reciever_id])
                ->hydrate(false)
                ->first();
            $message = array();
            if (!empty($chat_message)) {
                foreach ($chat_message as $val) {
                
                    
                    $queryinfo = $this->ChatMessages->query(); 
                    $queryinfo->update()
                    ->set(['soft_status' => 'Read'])
                    ->where(['id' => $val['id']])
                    ->execute();
                    $message['message'][] = $val['message'];
                    $message['id'][] = $user_info['id'];
                    $message['user_name'][] = $user_info['user_name'];
                    $message['image'][] = $user_info['image'];
                    $message['msg_time'][] = $val['msg_time'];
                    
                }
            }
            $result =[];
                foreach($message as $k => $d){
                    foreach($d as $key => $val){
                        $result[$key][$k] = $d[$key];
                    }
                }
            echo json_encode($result);
            die;
        }
    }
    
    
    public function likes()
    {
        if ($this->request->is('ajax')) {
           
            $data = $this->request->data; 
           
            $liked_user_id = $data['id']; 
            $this->loadModel('Users');
            $this->loadModel('States');
            $this->loadModel('Cities');
            $this->loadModel('UserLikes');
            $userId = $this->request->Session()->read('Auth.User.id');
            
            $like = $this->UserLikes->find()
                ->where(['liked_user_id'=>$liked_user_id,'user_id'=>$userId])
                ->count();
            if($like > 0) {
                echo 1;die;
            } else {
    
                $save['UserLikes']['liked_user_id'] = $liked_user_id;
                $save['UserLikes']['user_id'] = $userId;
                $rrr = $this->UserLikes->newEntity($save); 
                if($this->UserLikes->save($rrr)) {
                    $liked_user = $this->Users->find()
                        ->where(['Users.id'=>$liked_user_id])
                        ->hydrate(false)
                        ->first(); 
                   
                    $id = $liked_user['id'];     
                    $total_likes = $liked_user['users_like'] + 1;
                    $ulne['Users']['id'] =$id;
                    $ulne['Users']['users_like'] =$total_likes ;
                    $savelike5 = $this->Users->newEntity($ulne);
                    $this->Users->save($savelike5);
                   echo 2;
                   die;
               }
    
              
            } 
        }
    
    }
    
    public function dislikes()
    {
        if ($this->request->is('ajax')) {
            $data = $this->request->data; 
            $dislike_user_id = $data['id']; 
            $this->loadModel('Users');
            $this->loadModel('States');
            $this->loadModel('Cities');
            $this->loadModel('UserDislikes');
            $this->loadModel('UserLikes');
            $userId = $this->request->Session()->read('Auth.User.id');
            
            $like = $this->UserDislikes->find()
                ->where(['dislike_user_id'=>$dislike_user_id,'user_id'=>$userId])
                ->count();
    
            if ($like > 0) {
                echo 1;die;
            } else {
                $save['UserDislikes']['dislike_user_id'] = $dislike_user_id;
                $save['UserDislikes']['user_id'] = $userId;
                $rrr = $this->UserDislikes->newEntity($save); 
               
                $this->UserDislikes->save($rrr);
                $disliked_user = $this->Users->find()
                    ->where(['Users.id'=>$dislike_user_id])
                    ->hydrate(false)
                    ->first(); 
                   
                $id = $disliked_user['id'];     
                $total_dislikes = $disliked_user['users_dislike'] + 1;
                $ulne['Users']['id'] =$id;
                $ulne['Users']['users_dislike'] =$total_dislikes ;
                $savelike5 = $this->Users->newEntity($ulne);
                $this->Users->save($savelike5);
                echo 2;
                die;
            }
            
           
        }
    
    }
    
    public function voiceCalling()
    {
        $this->set('title','Friendoz | Voice Calling');
        $this->viewBuilder()->layout('public');
    }

    public function rateUserProfile($id = null)
    {
        $this->set('title','Rate Users Profile');
        $this->viewBuilder()->layout('public');
        $this->loadModel('Reviews');
        $userId = $this->request->Session()->read('Auth.User.id');
        $this->loadModel('Users');
        $id = $this->Utility->decode($id);
        $userInfo = $this->Users->find()
            ->where(['Users.id'=>$id])
            ->hydrate(false)
            ->first(); 
        $this->set(compact('userInfo')); //prx($userInfo);
        $review  = $this->Reviews->find()
                ->where(['user_id'=>$userId,'user_rating_id'=>$id,'status'=>'Active'])
                ->hydrate(false)
                ->first();
        $this->set(compact('review')); 
        $this->loadModel('UserLikes');
        $likesUser = $this->UserLikes->find('list',['valueField'=>'liked_user_id'])
            ->where(['user_id'=>$userId,'liked_user_id'=>$id])
            ->hydrate(false)
            ->first(); //prx($likesUser);
        $this->set(compact('likesUser'));
    
        $this->loadModel('UserDislikes');
        $dislikesUser = $this->UserDislikes->find('list',['valueField'=>'dislike_user_id'])
            ->where(['user_id'=>$userId,'dislike_user_id'=>$id])
            ->hydrate(false)
            ->first();
        $this->set(compact('dislikesUser'));
        if ($this->request->is('post')) {
            $data = $this->request->data;
            if (!empty($data)) {
                $info = $this->Reviews->newEntity($data);
                if ($this->Reviews->save($info)) {
                    $this->Flash->success('Yoour Review Save Successfully');
                    return $this->redirect($this->referer());
                }
            }                
        }
        /* find this user report or not */
        $this->loadModel('reportUsers');
        $reportUserCount = $this->reportUsers->find()
                            ->where(['report_by'=>$userId,'report_to'=>$id])
                            ->hydrate(false)
                            ->count();
        $this->set(compact('reportUserCount'));
        /* end find this user report or not */
    }

    public function blockUser()
    {
        if($this->request->is('post')) {
            $data = $this->request->data;
            $blockTime = date('Y-m-d H:i:s');
            $this->loadModel('blockUsers');
            $info['blockUsers']['user_by'] = $data['userBy'];
            $info['blockUsers']['user_to'] = $data['userTo'];
            $info['blockUsers']['date'] = $blockTime;
            $blockInfo = $this->blockUsers->newEntity($info);
            if($this->blockUsers->save($blockInfo)) {
                $this->Flash->info('User Block Successfully!!');
                $this->redirect(HTTP_ROOT.'home/profileListing');
            }
        }
    }

    public function reportUser()
    {
        if($this->request->is('post')) {
            $data = $this->request->data;
            $reportTime = date('Y-m-d H:i:s');
            $this->loadModel('reportUsers');
            $info['reportUsers']['report_by'] = $data['reportBy'];
            $info['reportUsers']['report_to'] = $data['reportTo'];
            $info['reportUsers']['reasons'] = $data['reason'];
            $info['reportUsers']['date'] = $reportTime;
            $reportInfo = $this->reportUsers->newEntity($info);
            $userId = $this->Utility->encode($data['reportTo']);
            if($this->reportUsers->save($reportInfo)) {
                $this->Flash->info('User Report Successfully!!');
                $this->redirect(HTTP_ROOT.'home/profile-Details/'.$userId);
            }
        }
    }

    public function createSinchUser()
    {
        if($this->request->is('ajax')) {
            $data = $this->request->data;
            $this->loadModel('Users');
            $userId = $this->request->session()->read('Auth.User.id');
            if(!empty($data)) {
                $query = $this->Users->query();
                $result = $query->update()
                        ->set(['sinch_user_name' => $data['sinchUser'],'sinch_password'=>$data['sinchPassword']])
                        ->where(['id' => $userId])
                        ->execute();
                $userInfo = $this->Users->find()
                    ->where(['id'=>$userId])
                    ->hydrate(false)
                    ->first();
                $this->request->session()->write('Auth.User.sinch_user_name',$userInfo['sinch_user_name']);
                $this->request->session()->write('Auth.User.sinch_password',$userInfo['sinch_password']);
                echo "success";
                die;
            }
        }
    }

    public function getIncomingUserDetails()
    {
        if($this->request->is('ajax')) {
            $data = $this->request->data;
            $this->loadModel('Users');
            if(!empty($data)) {
                $userInfo = $this->Users->find()
                            ->where(['sinch_user_name' => $data['username']])
                            ->select(['id','user_name','image'])
                            ->hydrate(false)
                            ->first();
                echo json_encode($userInfo);
                die;
            }
        }
    }

    public function callingLoginStatus()
    {
        if($this->request->is('ajax')) {
            $data = $this->request->data;
            if(!empty($data)) {
                $this->loadModel('Users');
                $loginStatus = $this->Users->find()
                    ->where(['id'=>$data['userId'],'login_status'=>1])
                    ->hydrate(false)
                    ->count();
                $msg;
                if($loginStatus == 1) {
                    $msg = "online";
                } else {
                    $msg = "offline";
                }
                echo json_encode($msg);
                die;
            }
        }
    }
 
    public function callingStart()
    {
        if($this->request->is('ajax')) {
            $data = $this->request->data;
            if(!empty($data)) {
                $this->loadModel('CallDetails');
                $senderId = $this->request->session()->read('Auth.User.id');
                $info['CallDetails']['sender_id'] = $senderId;
                $info['CallDetails']['reciver_id'] = $data['reciver_id'];
                $callInfo = $this->CallDetails->newEntity($info);
                if($this->CallDetails->save($callInfo)) {
                    $callDetailsId = $callInfo->id;
                    echo $callDetailsId;
                    die;
                }
            }
        }
    }

    public function callEstablished()
    {
        if($this->request->is('ajax')) {
            $data = $this->request->data;
            if(!empty($data)) {
                $this->loadModel('CallDetails');
                $query = $this->CallDetails->query();
                $result = $query->update()
                        ->set(['answer_at' => $data['answerAt']])
                        ->where(['id' => $data['callDetalsId']])
                        ->execute();
                echo json_encode("success");
                die;
            }
        }
    }

    public function callEnd()
    {
        if($this->request->is('ajax')) {
            $data = $this->request->data;
            if(!empty($data['callDetalsId'])) {
                $this->loadModel('CallDetails');
                $info['CallDetails']['id'] = $data['callDetalsId'];
                $info['CallDetails']['ended'] = $data['ended'];
                $info['CallDetails']['duration'] = $data['duration'];
                $info['CallDetails']['end_cause'] = $data['endcause'];
                $callInfo = $this->CallDetails->newEntity($info);
                if($this->CallDetails->save($callInfo)) {
                    echo json_encode("success");
                    die;
                }
            } else {
                echo json_encode("success");
                die;
            }
        }
    }

   
} ?>  