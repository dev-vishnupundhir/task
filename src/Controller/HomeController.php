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
    class HomeController extends AppController
    {   
        public function beforeFilter(Event $event)
        {
            $this->Auth->allow(['index','forgotPassword','resetPassword','faq','termsConditions','registration','voiceRecord','voiceUpload','dashboard','verifyEmail','profileListing','membershipPlans','getState','getCity','findVideo','profileDetails','userGallery','aboutUs','contacts','privacyPolicy']);
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
        
        public function index()
        {
            $this->viewBuilder()->layout("public");  
            $this->set('title','Friendoz | Find Friends and people near you');
            $this->loadModel('Texts');
            $this->loadModel('ClientTestimonials');
            $text = $this->Texts->find()->hydrate(false)->toArray();
            $this->set(compact('text'));//prx($text);
            $arr = array(6,7,8);
            $text_info = $this->Texts->find()->where(['id IN'=>$arr])->hydrate(false)->toArray();
            $this->set(compact('text_info'));//prx($text_info);
            $arr = array(9,10,11,15);
            $feautre = $this->Texts->find()->where(['id IN'=>$arr])->hydrate(false)->toArray();
            $this->set(compact('feautre'));//prx($feautre);
            $this->loadModel('Sliders');
            $slider = $this->Sliders->find()->hydrate(false)->toArray();
            $this->set(compact('slider')); //prx($slider);
            $testimonialInfo = $this->ClientTestimonials->find()
                                ->hydrate(false)
                                ->toArray();
            $this->set(compact('testimonialInfo'));
            $this->loadModel('OurPartners');
            $partner = $this->OurPartners->find()->hydrate(false)->toArray();
            $this->set(compact('partner'));
            $this->loadModel('Countries');
            $countries = $this->Countries->find()->hydrate(false)->toArray();
            $this->set(compact('countries'));
        }

        public function login() 
        {
            $this->viewBuilder()->layout("public");
            $this->set('title','Friendoz | Login');
            $this->loadModel('Users');
            if($this->Cookie->check('Auth.User')) {
                $memInfo = $this->Cookie->read('Auth.User');
                $this->set('cookieData',$memInfo);
            }    
            if($this->request->is('post')) {  
                $data = $this->request->data;
                if(!empty($data)) {
                    $validate = new ValidationController();
                    $errors = $validate->validateLogin($data);
                    if (!empty($errors)) { 
                        $this->set('errors',$errors);
                    } else {
                        $user = $this->Auth->identify();
                        if(!isset($data['remember'])) {
                            $this->Cookie->delete('Auth.User');
                        }
                        if ($user) {
                            $loginTime = date('Y-m-d H:i:s');
                            $query = $this->Users->query();
                            $result = $query->update()
                                    ->set(['last_login' => $loginTime,'login_status'=>1])
                                    ->where(['id' => $user['id']])
                                    ->execute();

                            if(isset($data['remember']) && !empty($data['remember'])) {
                                $this->Cookie->delete('Auth.User');
                                $cookie = array();
                                $cookie['username'] = $data['email'];
                                $cookie['password'] = $data['password'];
                                $this->Cookie->write('Auth.User', $cookie);
                            }
                            $this->Auth->setUser($user);
                            if(isset($this->request->query['q']) && $this->request->query['q'] == "membership-plan") {
                                $this->Flash->info('Welcome you have logged in Successfully');
                                $this->redirect('/home/membership-Plans');
                            } elseif(isset($this->request->query['p']) && $this->request->query['p'] == 'profile-listing') {
                                $this->Flash->info('Welcome you have logged in Successfully');
                                $this->redirect('/home/profileListing');
                            } elseif (isset($this->request->query['p']) && isset($this->request->query['id'])&& $this->request->query['p'] == 'profile-detail') { $id = $this->request->query['id'];
                                    $this->Flash->info('Welcome you have logged in Successfully');
                                    $this->redirect('/home/profileDetails/'.$id);
                            } else {
                                $this->Flash->info('Welcome you have logged in Successfully');
                                $this->redirect('/members/userDashboard'); 
                            }  
                        } else {
                            $this->Flash->error(__('Invalid username or password, try again'));
                        }
                    }    
                }
            }
        }

        
        public function forgotPassword()
        {
            $this->viewBuilder()->layout("public");
            $this->set('title','Friendoz | Forgot Password');
            if($this->request->is('post')) {
                $data = $this->request->data;
                if(isset($data) && !empty($data)) {
                    $this->loadModel('Users');
                    $check = $this->Users->forgotPass($data);
                    if($check == "success") {
                        $this->Flash->success('Reset Password link has been sent in your email id.');  
                        return $this->redirect([
                            'action' => 'login'
                        ]);       
                    } else {
                        $this->Flash->error('We will send message if email exits'); 
                        return $this->redirect([
                            'action' => 'login'
                        ]);        
                    }
                    
                }        
            }   
        }

        public function resetPassword($id = null, $email = null,$token = null) 
        {           
            $this->viewBuilder()->layout("public");
            $this->set('title','Friendoz | Reset Password');
            $uid = convert_uudecode(base64_decode($id));
            $this->set('uid',$uid);
            $this->loadModel('Users');
            $linkInfo = $this->Users->find()
            ->where(['id'=>$uid])
            ->select(['id','activation_key'])
            ->first();
            if($linkInfo['activation_key'] == $token ) {
                if($this->request->is('post')) {
                    $data = $this->request->data;
                    $this->Users->resetPass($data);
                    $this->Flash->success('Your Password Reset Successfully');
                    $this->redirect(HTTP_ROOT.'home/login');
                }   
            } else {
                $this->Flash->info('Your Reset Password link has been expired you can not access this page');
                $this->redirect(HTTP_ROOT.'home/login');
            }
        }

        public function logout()
        {
            $Uid = $this->request->session()->read('Auth.User.id');
            $this->loadModel('Users');
            $logoutTime = date('Y-m-d H:i:s');
            $query = $this->Users->query();
            $result = $query->update()
                    ->set(['last_logout' => $logoutTime,'login_status'=>0])
                    ->where(['id' => $Uid])
                    ->execute();
            $this->Auth->logout();
            $this->Flash->success("Logout successfully!");
            $this->redirect(HTTP_ROOT.'home/');
        }

        public function faq()
        {
            $this->viewBuilder()->layout("public");
            $this->set('title','Friendoz | Ask Queries');
            $this->loadModel('Faqs');
            $this->loadModel('FaqCategories');
            $faqCat = $this->FaqCategories->find()->where(['status'=>'Active'])->hydrate(false)->toArray();
            $this->set(compact('faqCat'));
            $this->paginate = array('limit'=>'5');
             $conditions = array();
            if(!empty($this->request->query['search']) || !empty($this->request->query['id'])) {
                $query = $this->request->query;
                if(isset($query['id']) && !empty($query['id'])) {
                    $faqInfo = $this->paginate($this->Faqs->find()->where(['Faqs.faq_category_id'=>$query['id'],'status'=>'Active'])->hydrate(false));
                    $faq =$faqInfo->toArray();
                    $this->set(compact('faq'));
                } elseif(isset($query['search']) && !empty($query['search'])) {
                    $query = $query['search'];
                    $conditions[] = array('OR'=>array('Faqs.question LIKE'=>'%'.$query.'%','Faqs.answer LIKE'=>'%'.$query.'%')); 
                    $faqInfo = $this->paginate($this->Faqs->find()->where([$conditions])->hydrate(false));
                    $faq =$faqInfo->toArray();
                    $this->set(compact('faq','query'));
                }

            } else {
                $faqInfo = $this->paginate($this->Faqs->find()->where(['status'=>'Active'])->hydrate(false));
                $faq =$faqInfo->toArray();
                $this->set(compact('faq'));
            }     
        }

        public function termsConditions()
        {
            $this->viewBuilder()->layout("public");
            $this->set('title','Friendoz | Terms & Conditions');
        }

        public function registration()
        {
            $this->viewBuilder()->layout("public");
            $this->set('title','Friendoz | Register Yourself');
            $this->loadModel('Countries');
            $this->loadModel('Users');
            $countryInfo = $this->Countries->activeCountry();
            $this->set(compact('countryInfo'));
            if($this->request->is('post')) {
                $data = $this->request->data;
                // prx($data);
                if(!empty($data)) {
                    $validate = new ValidationController();
                    $errors = $validate->validateUserRegister($data);
                    if (!empty($errors)) { 
                        $this->set('errors',$errors);
                    } else {
                        $userInfo = $this->Users->userReg($data);
                        if(!empty($data['Users']['profile-img']['name'])) {
                            $logo = $data['Users']['profile-img']['name'];
                            $ext = explode('.', $logo);
                            if($ext[1] == 'png' || $ext[1] == 'jpg' || $ext[1] == 'jpeg') {
                                $logo = $this->Utility->sanitizeFilename($logo);
                                $logo = $this->Utility->randomString() . '-' . $logo;
                                $sourcePath = $data['Users']['profile-img']['tmp_name'];;  // Storing source path of the file in a variable
                                $targetPath = '../webroot/img/profilePic/'.$logo; // Target path where file is to be stored
                                if(is_uploaded_file($sourcePath)) {
                                    $this->Resize->resize($sourcePath,$targetPath,'aspect_fit',250,250, 0, 0, 0, 0 );
                                    $info['Users']['id'] = $userInfo;
                                    $info['Users']['image'] = $logo; 
                                    $user_info1 = $this->Users->newEntity($info);
                                    $this->Users->save($user_info1);   
                                }
                            } else {
                                $this->Flash->error('Please Upload png,jpg,jpeg format profile image');
                                return $this->redirect(  
                                        $this->referer()
                                    );
                                exit();
                            }
                        }
                        if(isset($data['Users']['voice_upload']['name'])) {                    
                            if (!empty($data['Users']['voice_upload']['name'])) {
                                $vmsg = $data['Users']['voice_upload']['name'];
                                $ext = explode('.', $vmsg);
                                if($ext[1] == 'wav' || $ext[1] == 'mp3') {
                                    $target = realpath('../webroot/img/voiceMessage').'/';
                                    $tempFile = $data['Users']['voice_upload']['tmp_name'];
                                    $msg = $this->Utility->randomString() . '-' . $data['Users']['voice_upload']['name'];
                                    move_uploaded_file($tempFile, $target.$msg);
                                    $info['Users']['id'] = $userInfo;
                                    $info['Users']['voice_message'] = $msg; 
                                    $user_info1 = $this->Users->newEntity($info);
                                    $this->Users->save($user_info1); 
                                } else {
                                    $this->Flash->error('Please Upload wav,mp3 voice message');
                                    return $this->redirect(  
                                            $this->referer()
                                        );
                                        exit();
                                }  
                            }
                        }
                        if(!empty($data['Users']['voice_msg'])) {
                            $srcPath = '../webroot/img/temp/'.$data['Users']['voice_msg'];
                            $destinationPath = '../webroot/img/voiceMessage/'.$data['Users']['voice_msg'];
                            copy($srcPath,$destinationPath);
                            unlink($srcPath);
                            $info['Users']['id'] = $userInfo;
                            $info['Users']['voice_message'] = $data['Users']['voice_msg']; 
                            $user_info1 = $this->Users->newEntity($info);
                            $this->Users->save($user_info1); 
                        } 
                        $this->Flash->info('we have sent you an email. Please click on the verification link.');
                        $this->redirect(HTTP_ROOT.'home/');
                    }
                }
            } 
        }

    public function verifyEmail($uid = null, $email = null)
    {
        $id = convert_uudecode(base64_decode($uid));
        $this->loadModel('Users');
        $query = $this->Users->find()
            ->where(['id'=>$id])
            ->hydrate(false)
            ->first();
        $userId = $this->Utility->encode($query['id']);
        if($query['email_verify'] == 1) {
            $this->Flash->info('Link is Expired.');
            $this->redirect(HTTP_ROOT.'home/');
        } elseif(sha1($query['email']) == $email) {
            $temp = array();
            $temp['Users']['id'] = $query['id'];
            $temp['Users']['email_verify'] = 1;
            $temp['Users']['status'] = 'Active'; 
            $temp['Users']['created'] = date('Y-m-d H:m:s');
            $updateInfo = $this->Users->newEntity($temp);
            $this->Users->save($updateInfo);
            if($query['user_type'] == "user") {
                $this->request->session()->write('Auth.User.id',$query['id']);
                $this->request->session()->write('Auth.User.email',$query['email']);
                $this->request->session()->write('Auth.User.user_type',$query['user_type']);
                $this->request->session()->write('Auth.User.user_name',$query['user_name']);
                $this->redirect('/members/userDashboard');
            }
        }
    }

    public function membershipPlans()
    {
        $this->viewBuilder()->layout("public");
        $this->set('title','Friendoz | Membership Plans');
        $this->loadModel('MembershipPlans');
        $this->loadModel('MembershipPlansServices');
        $planInfo = $this->MembershipPlans->find()
                    ->contain(['MembershipPlansServices'])
                    ->hydrate(false)
                    ->toArray();
        $this->set(compact('planInfo'));

    }
        
        //by sonu 
        public function getState($countryId = null)   {
            $this->loadModel('States'); 
            $stateInfo = $this->States->find()
            ->where(['country_id'=>$countryId])
            ->hydrate(false)
            ->toArray();
            echo json_encode($stateInfo);
            die;
        }
        public function getCity($stateId = null)   
        {
            $this->loadModel('Cities');
            $citiInfo = $this->Cities->find()
            ->where(['state_id'=>$stateId])
            ->hydrate(false)
            ->toArray();
            echo json_encode($citiInfo);
            die;
        }

        public function profileListing()
        {
           
            $this->set('title','Profile Listing');
            $this->viewBuilder()->layout('public');
            $this->loadModel('Users');
            $this->loadModel('Countries');
            $this->loadModel('States');
            $this->loadModel('Cities');
            $countries = $this->Countries->find()->hydrate(false)->toArray();
            $this->set(compact('countries'));
            $userId = $this->request->Session()->read('Auth.User.id');//login user id
            $this->set(compact('userId')); 
               
            $this->paginate = array('limit'=>'2');

            // $userDet = $this->paginate($this->Users->find()->contain(['Countries','States','Cities'])->where(['Users.id <>'=>$userId])->hydrate(false));
            // $userDeta = $userDet->toArray(); 
            // $array_size=count($userDeta);
            // $this->set(compact('userDeta','array_size'));//set data on element of people_listing

            $userDeta_count = $this->Users->find()
                ->contain(['Countries','States','Cities'])
                ->count(); //prx($userDeta);
            $this->set(compact('userDeta_count'));
            
            $userVideo = $this->Users->find()
                ->contain(['Countries','States','Cities'])
                ->where(['Users.id'=>$userId])
                ->hydrate(false)
                ->first(); 
            $this->set(compact('userVideo'));// login video play of users countries
            //prx($userVideo);

            $this->loadModel('UserLikes');
            $likesUser = $this->UserLikes->find('list',['valueField'=>'liked_user_id'])
                ->where(['user_id'=>$userId])
                ->hydrate(false)
                ->toArray();
            $this->set(compact('likesUser'));

            $this->loadModel('UserDislikes');
            $dislikesUser = $this->UserDislikes->find('list',['valueField'=>'dislike_user_id'])
                ->where(['user_id'=>$userId])
                ->hydrate(false)
                ->toArray();
            $this->set(compact('dislikesUser'));

            if ($this->request->is('ajax')) {
                $data = $this->request->data; 
                $this->viewBuilder()->layout('ajax');
                $name =$data['name'];
                $gender =$data['gender'];
                $contId =$data['country'];
                $sateId =$data['state'];
                $cityId =$data['city'];
               
                $this->loadModel('Users');
                $this->loadModel('States');
                $this->loadModel('Cities');

                $userId = $this->request->Session()->read('Auth.User.id');//prx($userId);
                
                $conditions =array();
                if (!empty($name)) {
                  $conditions = array_merge($conditions,array('Users.user_name LIKE'=>'%'.$name.'%')); 

                }
                if (!empty($gender)) {
                  $conditions = array_merge($conditions,array('Users.gender'=>$gender));  
                }
                if (!empty($contId)) {
                  $conditions = array_merge($conditions,array('Users.country_id'=>$contId));  
                }

                if (!empty($sateId)) {
                  $conditions = array_merge($conditions,array('Users.state_id'=>$sateId));  
                }
                
                if (!empty($cityId)){
                  $conditions = array_merge($conditions,array('Users.city_id'=>$cityId));  
                }
                if (!empty($data['Users']['age'])){
                    $choiceAge = explode("-",$data['Users']['age']);
                    $sage = $choiceAge[0];
                    $eage = $choiceAge[1];
                    $conditions = array_merge($conditions,array('Users.age >='=>$sage,'Users.age <='=>$eage));
                }
                $conditions = array_merge($conditions,array('Users.status'=>"Active"));                 
                $this->paginate = array('limit'=>'2');
                if (!empty($userId)) { 
                    $this->loadModel('blockUsers');
                    $blockuserTo = $this->blockUsers->find('list', [
                            'keyField' => 'id',
                            'valueField' => 'user_to'
                        ])
                        ->where(['user_by' => $userId])
                        ->orWhere(['user_to' => $userId])
                        ->hydrate(false)
                        ->toArray();
                    $blockuserby = $this->blockUsers->find('list', [
                                'keyField' => 'id',
                                'valueField' => 'user_by'
                            ])
                        ->where(['user_by' => $userId])
                        ->orWhere(['user_to' => $userId])
                        ->hydrate(false)
                        ->toArray();
                    $blockUser = array_merge($blockuserTo,$blockuserby);
                    if(!empty($blockUser)) {
                        $userDet = $this->paginate($this->Users->find()
                            ->contain(['Countries','States','Cities'])
                            ->where([$conditions,'Users.id <>'=>$userId,'Users.id NOT IN'=>$blockUser])
                            ->hydrate(false));
                    } else {
                        $userDet = $this->paginate($this->Users->find()
                            ->contain(['Countries','States','Cities'])
                            ->where([$conditions,'Users.id <>'=>$userId])
                            ->hydrate(false));
                    }
                    
                    $userDeta = $userDet->toArray();
                    $array_size=count($userDeta);
                   // prx($userDeta);die;
                } else {
                    $userDet = $this->paginate($this->Users->find()
                        ->contain(['Countries','States','Cities'])
                        ->where([$conditions])
                        ->hydrate(false));
                    $userDeta = $userDet->toArray();
                    $array_size=count($userDeta);
                }
                $this->set(compact('userDeta',"array_size"));
                
                $this->render('/Element/frnt/people_listing');

            } elseif (!empty($this->request->query)) {

                $query = $this->request->query;  //prx($query);
                $conditions = array();
                
                if (!empty($query['start_age']) && !empty($query['end_age'])) {
                    
                    $conditions = array_merge($conditions,array('Users.age >='=>$query['start_age'],'Users.age <='=>$query['end_age']));
                    
                }
               
                if (!empty($query['country_id']) && isset($query['country_id'])) {
                    $conditions = array_merge($conditions,array('Users.country_id'=>$query['country_id']));                  
                }
                if (!empty($query['gender']) && isset($query['gender'])) {
                    $conditions = array_merge($conditions,array('Users.gender'=>$query['gender']));   

                }
                $conditions = array_merge($conditions,array('Users.status'=>"Active"));
                $this->paginate = array('limit'=>'2');
                if (!empty($userId)) {
                    $this->loadModel('blockUsers');
                    $blockuserTo = $this->blockUsers->find('list', [
                                'keyField' => 'id',
                                'valueField' => 'user_to'
                            ])
                        ->where(['user_by' => $userId])
                        ->orWhere(['user_to' => $userId])
                        ->hydrate(false)
                        ->toArray();
                    $blockuserby = $this->blockUsers->find('list', [
                                'keyField' => 'id',
                                'valueField' => 'user_by'
                            ])
                        ->where(['user_by' => $userId])
                        ->orWhere(['user_to' => $userId])
                        ->hydrate(false)
                        ->toArray();
                    $blockUser = array_merge($blockuserTo,$blockuserby);
                    if(!empty($blockUser)) {
                         $userDet = $this->paginate($this->Users->find()
                            ->contain(['Countries','States','Cities'])
                            ->where([$conditions,'Users.id <>'=>$userId,'Users.id NOT IN'=>$blockUser])
                            ->hydrate(false));
                     } else {
                        $userDet = $this->paginate($this->Users->find()
                            ->contain(['Countries','States','Cities'])
                            ->where([$conditions,'Users.id <>'=>$userId])
                            ->hydrate(false));
                     }  
                    $userDeta = $userDet->toArray(); 
                    $array_size=count($userDeta);
                } else {
                    $userDet = $this->paginate($this->Users->find()
                        ->contain(['Countries','States','Cities'])
                        ->where([$conditions])
                        ->hydrate(false));
                    $userDeta = $userDet->toArray(); 
                    $array_size=count($userDeta);
                }
                $this->set(compact('userDeta','query','array_size')); 

                $states = $this->States->find()
                    ->where(['country_id'=>$query['country_id']])
                    ->hydrate(false)
                    ->toArray();
                $this->set(compact('states'));
                if (!empty($query['country_id'])) {
                    $userVideo = $this->Countries->find()
                        ->where(['id'=>$query['country_id']])
                        ->hydrate(false)
                        ->first();
                    $this->set(compact('userVideo')); //prx($userVideo);
                }
                   
            } elseif(!empty($userId)) {
                $this->loadModel('blockUsers');
                $blockuserTo = $this->blockUsers->find('list', [
                            'keyField' => 'id',
                            'valueField' => 'user_to'
                        ])
                    ->where(['user_by' => $userId])
                    ->orWhere(['user_to' => $userId])
                    ->hydrate(false)
                    ->toArray();
                $blockuserby = $this->blockUsers->find('list', [
                            'keyField' => 'id',
                            'valueField' => 'user_by'
                        ])
                    ->where(['user_by' => $userId])
                    ->orWhere(['user_to' => $userId])
                    ->hydrate(false)
                    ->toArray();
                $blockUser = array_merge($blockuserTo,$blockuserby);
                if(!empty($blockUser)) {
                     $userDet = $this->paginate($this->Users->find()
                        ->contain(['Countries','States','Cities'])
                        ->where(['Users.id <>'=>$userId,'Users.id NOT IN'=>$blockUser,'Users.status'=>"Active"])
                        ->hydrate(false));
                 } else {
                     $userDet = $this->paginate($this->Users->find()
                        ->contain(['Countries','States','Cities'])
                        ->where(['Users.id <>'=>$userId,'Users.status'=>"Active"])
                        ->hydrate(false));
                 }
               
                $userDeta = $userDet->toArray(); //prx($userDeta);
                $array_size=count($userDeta);
                // prx($userDet);
                //$this->set(compact('userDeta','array_size'));
            } else {
                $userDet = $this->paginate($this->Users->find()
                    ->contain(['Countries','States','Cities'])->where(['Users.status'=>"Active"])
                    ->hydrate(false));
                $userDeta = $userDet->toArray(); //prx($userDeta);
                $array_size=count($userDeta);

                
            } 
            $this->set(compact('userDeta','array_size'));   
           
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
                       echo 'liked';
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
                    echo 'disliked';
                    die;
                }
                
               
            }

        }

        public function findVideo()
        {
            if ($this->request->is('ajax')) {
                $data = $this->request->data;
                $c_id = $data['cid'];
                $this->loadModel('Countries');
                //if (!empty($c_id)) {
                    $cVideo = $this->Countries->find()->where(['id'=>$c_id])->hydrate(false)->first();
                    $c_url = $cVideo['country_url'];
                     echo $c_url;
                    die;
                //}
                
            }
        }

        public function profileDetails($id = null)
        {
            $this->set('title','Profile Details');
            $this->viewBuilder()->layout('public');
            $this->loadModel('Users');
            $this->loadModel('UserViews');
            $userId = $this->Utility->decode($id);
            $loginUserId = $this->request->session()->read('Auth.User.id');
            if($userId == $loginUserId) {
               $this->redirect(HTTP_ROOT.'home/profileListing');
            } else {
                $viewTime = date('Y-m-d H:i:s');
                $userInfo = $this->Users->find()
                            ->contain(['Countries','States','Cities','UserPictures'])
                            ->where(['Users.id'=>$userId])
                            ->hydrate(false)
                            ->first();
                if($loginUserId) {
                    $query = $this->UserViews->find()
                            ->where(['user_id' => $loginUserId,'viewed_user_id'=>$userId]);
                    $getViewCount = $query->count();
                    if(empty($getViewCount)) {
                        $data['UserViews']['viewed_user_id'] = $userId;
                        $data['UserViews']['user_id'] = $loginUserId;
                        $data['UserViews']['created'] = $viewTime;
                        $info = $this->UserViews->newEntity($data);
                        if($this->UserViews->save($info)) {
                            $totalViews = $userInfo['views'] + 1;
                            $query = $this->Users->query();
                            $result = $query->update()
                            ->set(['views' => $totalViews])
                            ->where(['id' => $userId])
                            ->execute();
                        }
                    }
                } else {
                    $systemIp = $this->getUserIP();
                    $query = $this->UserViews->find()
                            ->where(['ip_address' => $systemIp,'viewed_user_id'=>$userId]);
                    $getViewCount = $query->count();
                    if(empty($getViewCount)) {
                        $data['UserViews']['viewed_user_id'] = $userId;
                        $data['UserViews']['ip_address'] = $systemIp;
                        $data['UserViews']['created'] = $viewTime;
                        $info = $this->UserViews->newEntity($data);
                        if($this->UserViews->save($info)) {
                            $totalViews = $userInfo['views'] + 1;
                            $query = $this->Users->query();
                            $result = $query->update()
                            ->set(['views' => $totalViews])
                            ->where(['id' => $userId])
                            ->execute();
                        }
                    }
                }
                 $userInfo = $this->Users->find()
                            ->contain(['Countries','States','Cities','UserPictures'])
                            ->where(['Users.id'=>$userId])
                            ->hydrate(false)
                            ->first();
                $this->set(compact('userInfo'));
                 $this->loadModel('UserLikes');
                $loginUserId = $this->request->Session()->read('Auth.User.id');
                $likesUser = $this->UserLikes->find('list',['valueField'=>'liked_user_id'])
                    ->where(['user_id'=>$loginUserId,'liked_user_id'=>$userId])
                    ->hydrate(false)
                    ->first(); //prx($likesUser);
                $this->set(compact('likesUser'));
        
                $this->loadModel('UserDislikes');
                $dislikesUser = $this->UserDislikes->find('list',['valueField'=>'dislike_user_id'])
                    ->where(['user_id'=>$loginUserId,'dislike_user_id'=>$userId])
                    ->hydrate(false)
                    ->first();
                $this->set(compact('dislikesUser'));
                /* find this user report or not */
                $this->loadModel('reportUsers');
                $reportUserCount = $this->reportUsers->find()
                                    ->where(['report_by'=>$loginUserId,'report_to'=>$userId])
                                    ->hydrate(false)
                                    ->count();
                $this->set(compact('reportUserCount'));
                /* end find this user report or not */
            }
            
        }

        function getUserIP()
        {
            $client  = @$_SERVER['HTTP_CLIENT_IP'];
            $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
            $remote  = $_SERVER['REMOTE_ADDR'];

            if(filter_var($client, FILTER_VALIDATE_IP))
            {
                $ip = $client;
            }
            elseif(filter_var($forward, FILTER_VALIDATE_IP))
            {
                $ip = $forward;
            }
            else
            {
                $ip = $remote;
            }

            return $ip;
        }


        public function userGallery($id = null)
        {
            $this->set('title','View Photos');
            $this->viewBuilder()->layout('public');
            $this->loadModel('Users');
            $userId = $this->Utility->decode($id);
            $loginUserId = $this->request->Session()->read('Auth.User.id');
            $userInfo = $this->Users->find()
                        ->contain(['Countries','States','Cities','UserPictures'])
                        ->where(['Users.id'=>$userId])
                        ->hydrate(false)
                        ->first();
            $this->set(compact('userInfo'));
             $this->loadModel('UserLikes');
            $likesUser = $this->UserLikes->find('list',['valueField'=>'liked_user_id'])
                ->where(['user_id'=>$loginUserId,'liked_user_id'=>$userId])
                ->hydrate(false)
                ->first(); //prx($likesUser);
            $this->set(compact('likesUser'));
    
            $this->loadModel('UserDislikes');
            $dislikesUser = $this->UserDislikes->find('list',['valueField'=>'dislike_user_id'])
                ->where(['user_id'=>$loginUserId,'dislike_user_id'=>$userId])
                ->hydrate(false)
                ->first();
            $this->set(compact('dislikesUser'));
            /* find this user report or not */
            $this->loadModel('reportUsers');
            $reportUserCount = $this->reportUsers->find()
                                ->where(['report_by'=>$loginUserId,'report_to'=>$userId])
                                ->hydrate(false)
                                ->count();
            $this->set(compact('reportUserCount'));
            /* end find this user report or not */
        }

        public function aboutUs()
        {
            $this->set('title','Friendoz | About Us');
            $this->viewBuilder()->layout('public');
            $this->loadModel('AboutUs');
            $about = $this->AboutUs->find()->hydrate(false)->first();
            $this->set(compact('about'));
            $this->loadModel('OurTeams');
            $team = $this->OurTeams->find()->hydrate(false)->toArray();
            $this->set(compact('team'));
        }

        public function contacts()
        {
            $this->set('title','Friendoz | Contact Us');
            $this->viewBuilder()->layout('public');
            $this->loadModel('Contacts');
            $this->loadModel('Users');
            $userId = $this->request->session()->read('Auth.User.id'); 
            if (!empty($userId)) {
                $loginUser = $this->Users->find()
                    ->where(['Users.id'=>$userId])->hydrate(false)->first();
                $this->set(compact('loginUser'));
            }
            if ($this->request->is('post')) {
                $data = $this->request->data; 
                if (!empty($data)) {
                    $info['Contacts']['user_name'] = $data['Contacts']['user_name'];
                    $info['Contacts']['email_id'] = $data['Contacts']['email_id'];
                    $info['Contacts']['phone'] = $data['Contacts']['phone'];
                    $info['Contacts']['message'] = $data['Contacts']['message'];
                    $info['Contacts']['date'] = date('Y-m-d H:i:s');
                    $save_info = $this->Contacts->newEntity($info);
                    if($this->Contacts->save($save_info)) {
                        $this->Flash->success('Your Message Send Successfully');
                        return $this->redirect($this->referer());
                    }
                }

            }
        }
        
        public function privacyPolicy()
        {
            $this->set('title','Friendoz | Privacy & Policy');
            $this->viewBuilder()->layout("public");
            $this->loadModel('Cms');
            $privacy = $this->Cms->find()
                ->where(['Cms.id'=>1])
                ->hydrate(false)
                ->first();
            $this->set(compact('privacy'));
        }
    } 
?>