<?php 
namespace App\Controller\Admin;

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
use Cake\Utility\Inflector;
use App\Controller\ValidationController as Validation;


ob_start();
    class UsersController extends AppController 
    {   
        public function beforeFilter(Event $event)
        {
             // $this->Auth->allow(['forgotPassword','resetPassword']);
        }
        
        public function initialize()
        {
            parent::initialize();
            // $this->loadComponent('Auth', [
            //     'loginAction' => [
            //         'controller' => 'Users',
            //         'action' => 'login',
            //     ],
            //     'authError' => 'Did you really think you are allowed to see that?',
            //     'authenticate' => [
            //         'Form' => [
            //             'fields' => ['username' => 'username', 'password' => 'password'],
            //             'userModel' => 'Admins',
            //             // 'finder' => 'auth'
            //         ]
            //     ],
            //     'storage' => 'Session'
            // ]);
        }

        public function login()
        {
            $this->set('title','Admin login');
            $this->viewBuilder()->layout('admin_login');
            if($this->Cookie->check('Auth.User')) {
                $memInfo = $this->Cookie->read('Auth.User');
                $this->set('cookieData',$memInfo);
            }
            
            if ($this->request->is('post')) {
                $data = $this->request->data;
                $validate = new Validation();
                $errors = $validate->validateAdminLogin($data); 
                if(!isset($data['remember'])){
                    $this->Cookie->delete('Auth.User');
                }
                if (empty($errors)) {
                    
                    if(isset($data['remember']) && !empty($data['remember'])){
                        $this->Cookie->delete('Auth.User');
                        $cookie = array();
                        $cookie['username'] = $data['username'];
                        $cookie['password'] = $data['password'];
                        $this->Cookie->write('Auth.User', $cookie);
                    }
                    $this->loadModel('Admins');
                    $admin = $this->Admins->find()->where(['username'=>trim($data['username']),'decode_password'=>trim($data['password'])])->hydrate(false)->first();
                    
                    if(!empty($admin)) {
                        $this->request->session()->write('AdminInfo',$admin);
                        return $this->redirect(HTTP_ROOT.'admin/users/dashboard');
                    } else {
                        $this->Flash->error(__('Invalid username or password, try again'));
                    }  
                }   
            }   
        }

        public function dashboard()
        {
            $this->set('title','Admin Dashboard');
            $this->viewBuilder()->layout('admin_dashboard');
        }
        
        public function profile()
        {

            $this->set('title','Admin Profile');
            $this->viewBuilder()->layout('admin_dashboard');
            $admins = TableRegistry::get('Admins');
            $admin_profile = $admins->adminInfo();
            $this->set('admin_profile', array('Admins'=>$admin_profile));
            if($this->request->is('post')){
                $id = $this->request->session()->read('AdminInfo.id');
                $data = $this->request->data;
                $admin_profile = $admins->adminInfo($id,$data);
                $this->request->session()->write('Auth.User.firstname',$admin_profile['firstname']);
                $this->Flash->success('Your Profile Updated Successfully');
                $this->set('admin_profile', array('Admins'=>$admin_profile));
            }    
        }

        public function changePassword()
        {
            if($this->request->is('post')){
                $admins = TableRegistry::get('Admins');
                $id = $this->request->session()->read('AdminInfo.id');
                $data = $this->request->data; 
                $admin_profile = $admins->changepass($id,$data);
                $this->Flash->success('Your Password Change Successfully');
                $this->redirect(HTTP_ROOT.'admin/users/profile');
            }
        }

        public function changeProfilePic()
        {   
            if( !empty($_FILES['image']['name'])) {
                $admins = TableRegistry::get('Admins');
                $id = $this->request->session()->read('AdminInfo.id');
                $img_name = $this->imgUpload($_FILES,'100','80','../webroot/img/profilePic','250','250');
                $this->request->session()->write('AdminInfo.image',$img_name);
                $info['Admins']['id'] = $id;
                $info['Admins']['image'] = $img_name;
                $adminInfo = $admins->newEntity($info);
                if(!empty($img_name)){
                    $admins->unlinkImage($id);
                }
                if(!is_object($img_name) && $admins->save($adminInfo)) {
                    $this->Flash->success('Your Profile Pic Updated Successfully');
                    $this->redirect(HTTP_ROOT.'admin/users/profile');
                }
            } else {
                $this->redirect(HTTP_ROOT.'admin/users/profile');  
            }
        }

        public function forgotPassword() 
        {
            if($this->request->is('post')){
                $data = $this->request->data;
                if(isset($data) && !empty($data)){
                    $this->loadModel('Admins');
                    $check = $this->Admins->forgotPass($data);
                    if($check == "success") {
                        $this->Flash->success('Password has been sent in your email id.');  
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

        public function resetPassword($token = null) 
        {           
            $this->set('title','Admin Reset Password');         
            $this->viewBuilder()->layout('admin_login');
            $this->loadModel('Admins');
            $linkInfo = $this->Admins->find()
            ->where(['id'=>1])
            ->select(['id','activation_key'])
            ->first();
            if($linkInfo['activation_key'] == $token ){
                if($this->request->is('post')){
                    $data = $this->request->data;
                    $this->Admins->resetPass($data);
                    $this->Flash->success('Your Password Reset Successfully');
                    $this->redirect(HTTP_ROOT.'admin/users/login');

                }   
            } else {
                $this->Flash->info('Your Reset Password link has been expired you can not access this page');
                $this->redirect(HTTP_ROOT.'admin/users/login');
            }

        }

        public function logout()
        {
            
            $this->redirect(HTTP_ROOT.'users/login');
        }

        public function PrivateStatus()
        {
            $status=$_POST['status'];
            $id = $_POST['id'];
            $table = $_POST['table'];
            $database = $this->loadModel($table);
            $query = $database->query();
                $query->update()
                ->set(['status' => $status])
                ->where(['id' => $id])
                ->execute();
                echo 1;
            die;
        }

        public function emailTemplates()
        {
            $this->set('title','Email Template');
            $this->viewBuilder()->layout('admin_dashboard');
            $this->loadModel('EmailTemplates');
            $query = $this->EmailTemplates->find('all');
            $query->select(['id', 'from_name', 'from_email', 'subject', 'html_content', 'description']);
            $query->hydrate(false);
            $emaildata = $query->toArray();
            $this->set('emaildata', $emaildata);
        }

        public function editEmailTemplate($id = null)
        {
            $this->set('title','Email Template');
            $this->viewBuilder()->layout('admin_dashboard');
            $this->loadModel('EmailTemplates');
            if(!empty($id)) {
                $id = $this->Utility->decode($id);
                $queryInfo = $this->EmailTemplates->find()
                ->where(['id' => $id]);
                $queryInfo->select(['id', 'from_name', 'from_email', 'subject', 'html_content', 'description']);
                $email_data = $queryInfo->first()->toArray();
               // prx($email_data);
                $this->set('email_data', $email_data);
            }

            if( !empty($this->request->data)) {
                $data = $this->request->data;
                if(isset($data) && !empty($data)) {
                    $entity = $this->EmailTemplates->newEntity($data); 
                    $this->EmailTemplates->save($entity);
                    $this->Flash->success('Your Data Updated Successfully');
                    return $this->redirect(  HTTP_ROOT.'admin/users/emailTemplates');
                }
                exit();
            }  
        }

        public function faqCategory() 
        {
            $this->set('title','FAQ Category');
            $this->viewBuilder()->layout('admin_dashboard'); 
            $category = $this->loadModel('FaqCategories');
            $this->paginate = array('limit'=>'10');
            $info = $this->paginate($category->find()
            ->order(['id'=>'DESC'])
            ->hydrate(false));
            $post_info = $info->toArray();
            $this->set('info',$post_info);
            $conditions = array();
            if(!empty($this->request->query)) {
                $query = $this->request->query;
                if(!empty($query['title'])) {
                    $conditions = array_merge($conditions,array('FaqCategories.title LIKE'=>'%'.$query['title'].'%'));                  
                }  
                $this->paginate = array('limit'=>'10');
                $info = $this->paginate($category->find()
                ->where([$conditions])
                ->order(['id' => 'desc'])
                ->hydrate(false));
                $info = $info->toArray(); 
                $this->set(compact('info','query'));
            }
        }

        public function addFaqCategory() 
        {
            $this->viewBuilder()->layout('admin_dashboard');
            $this->set('title','Add FAQ Category ');
            $this->loadModel('FaqCategories');
            if($this->request->is('post')){
                $data = $this->request->data;
                $faqCategorie_info = $this->FaqCategories->saveFaqCategorie($data);
                if($faqCategorie_info == "success") {
                    $this->Flash->success('Your Post Saved Successfully');
                    $this->redirect(HTTP_ROOT.'admin/users/faqCategory');
                }
            }
        }

        public function editFaqCategory($id = null) 
        {
            $this->viewBuilder()->layout('admin_dashboard');
            $this->set('title','Edit FAQ Category');
            $this->loadModel('FaqCategories');
            $id = $this->Utility->decode($id);
            $faq = $this->FaqCategories->getFaqCategory($id);
            $this->set(compact('faq'));
            if($this->request->is('post')){
                $data = $this->request->data;
                $editFaqs = $this->FaqCategories->editFaq($data);
                if($editFaqs == "success") {
                    $this->Flash->success('Your Post Saved Successfully');
                    $this->redirect(HTTP_ROOT.'admin/users/faqCategory');
                }
            }
        }

        public function faqs() 
        {
            $this->set('title','FAQs');
            $this->viewBuilder()->layout('admin_dashboard');
            $category = $this->loadModel('Faqs');
            $this->paginate = array('limit'=>'10');
            $info = $this->paginate($category->find()
            ->contain(['FaqCategories'])
            ->order(['Faqs.id'=>'DESC'])
            ->hydrate(false));
            $post_info = $info->toArray();
            $this->set('info',$post_info);

            $conditions = array();

            if(!empty($this->request->query)) {
                $query = $this->request->query;
                if(!empty($query['title']))
                {
                    $conditions = array_merge($conditions,array('FaqCategories.title LIKE'=>'%'.$query['title'].'%'));                  
                }
                if(!empty($query['question']))
                {
                    $conditions = array_merge($conditions,array('Faqs.question LIKE'=>'%'.$query['question'].'%'));                  
                }  
                if(!empty($query['answer']))
                {
                    $conditions = array_merge($conditions,array('Faqs.answer LIKE'=>'%'.$query['answer'].'%'));
                }  
                $this->paginate = array('limit'=>'10');
                $info = $this->paginate($category->find()
                ->where([$conditions])
                ->contain(['FaqCategories'])
                ->order(['Faqs.id' => 'desc'])
                ->hydrate(false));
                $info = $info->toArray();
               //prx($info); 
            $this->set(compact('info','query'));

            }
        }

        public function addFaqs() 
        {
            $this->viewBuilder()->layout('admin_dashboard');
            $this->set('title','Add FAQ');
            $this->loadModel('Faqs');
            $this->loadModel('FaqCategories');
            $fqCategory = $this->FaqCategories->find()
            ->hydrate(false)
            ->toArray();
            $this->set(compact('fqCategory'));
            if($this->request->is('post')){
                $data = $this->request->data;
                $blog_info = $this->Faqs->faqs($data);
                if($blog_info == "success") {
                    $this->Flash->success('Your Post Saved Successfully');
                    $this->redirect(HTTP_ROOT.'admin/users/faqs');
                }
            }
        }

        public function editFaqs($id = null) 
        {
            $this->viewBuilder()->layout('admin_dashboard');
            $this->set('title','Edit FAQ');
            $this->loadModel('Faqs');
            $this->loadModel('FaqCategories');
            $fqCategory = $this->FaqCategories->find()
            ->hydrate(false)
            ->toArray();
            $id = $this->Utility->decode($id);
            $faq = $this->Faqs->faqInfo($id);
            $this->set(compact('faq','fqCategory'));
            if($this->request->is('post')) {
                $data = $this->request->data;
                $blog_info = $this->Faqs->faqs($data);
                if($blog_info == "success") {
                    $this->Flash->success('Your Post Saved Successfully');
                    $this->redirect(HTTP_ROOT.'admin/users/faqs');
                }
            }
        }

        public function newCommonDelete($id=null,$table=null)
        {   
            if($this->request->is('ajax')) {
                $data = $this->request->data;
                //prx($data);
                $id = $this->Utility->decode($data['template_id']);
                $tables = $this->loadModel($data['table']);
                $enty = $tables->get($id);
                $tables->delete($enty);
                $this->Flash->success('Deleted Successfully ');
                echo 'success';
                die;
            }
        }

        public function userManagement()
        {
            $this->viewBuilder()->layout("admin_dashboard");
            $this->set("title","User Management");
            $category = $this->loadModel('Users');
            $this->paginate = array('limit'=>'10');
            $info = $this->paginate($category->find()->order(['id'=>'DESC'])->where(['user_type' => 'user'])->hydrate(false));
            $contactInfo = $info->toArray();
            $this->set(compact('contactInfo'));

            $conditions = array();

            if(!empty($this->request->query)) {
                $query = $this->request->query; //prx($query);
                   
                if(!empty($query['username']))
                {   $query['username'] = trim($query['username']);
                    $conditions = array_merge($conditions,array('Users.user_name LIKE'=>'%'.$query['username'].'%'));                
                }  
                if(!empty($query['email']))
                {   $query['email'] = trim($query['email']);
                    $conditions = array_merge($conditions,array('Users.email LIKE'=>'%'.$query['email'].'%'));                  
                }
                if(!empty($query['phone']))
                {   $query['phone'] = trim($query['phone']);
                    $conditions = array_merge($conditions,array('Users.phone LIKE'=>'%'.$query['phone'].'%'));
                }  
                if(!empty($query['age']))
                {   
                    $query['age'] = trim($query['age']);
                    $conditions = array_merge($conditions,array('Users.age LIKE'=>'%'.$query['age'].'%'));
                }
                $this->paginate = array('limit'=>'10');
                $info = $this->paginate($this->Users->find()
                ->where([$conditions])
                ->order(['Users.id' => 'desc'])
                ->hydrate(false));
                $contactInfo = $info->toArray();
               //prx($info); 
            $this->set(compact('contactInfo','query'));

            }
        }

         public function text()
    {
        $this->set('title','Texts Management');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('Texts');
        $this->paginate = array('limit'=>'10');
        $txts = $this->paginate($this->Texts->find()
                    ->hydrate(false));
        $txt =$txts->toArray();
        $this->set('txt',$txt);
        
    }

    public function editText($id = null)
    {
        $this->set('title','Edit Texts Management');
        $this->loadModel('Texts');
        $this->viewBuilder()->layout('admin_dashboard');
        $id = $this->Utility->decode($id);
        $txt = $this->Texts->find()
                    ->where(['Texts.id'=>$id])
                    ->hydrate(false)
                    ->first();
        $this->set('txt',$txt);//prx($txt);
        $this->loadComponent('Resize');
        if ($this->request->is('post')) {
            $data = $this->request->data; //prx($data);
            if (!empty($data)) {
                
                $target = '../webroot/img/images';
                if (!empty($_FILES['image']['name'])) {
                    $image_name = pathinfo($_FILES['image']['name']);
                    $ext = $image_name['extension'];
                    $new_image = rand(4,10000);
                    $img_name = $new_image.'.'.$ext;//prx($img_name);
                    $targetpath = realpath($target).'/'.$img_name;//prx($targetpath);
                    $source = $_FILES['image']['tmp_name'];
                    if(is_uploaded_file($source)) {
                        //move_uploaded_file($source, $targetpath);
                        if($data['Texts']['id'] == 9 || $data['Texts']['id']==10 || $data['Texts']['id']== 11 || $data['Texts']['id']== 15){
                            $this->Resize->resize($source,$targetpath,'aspect_fill',750,1205,0,0,0,0);
                        }else {
                           $this->Resize->resize($source,$targetpath,'aspect_fill',610,610,0,0,0,0); 
                        }
                        

                        if (file_exists('../webroot/img/images/'.$data['old_image'])) {
                            @unlink('../webroot/img/images/'.$data['old_image']);
                        }
                        $data['Texts']['image'] = $img_name;

                    }
                }
                unset($data['image']);
                $update = $this->Texts->newEntity($data);//prx($data);
                $update['Texts']['created'] = date("Y-m-d H:i:s");
                if ($this->Texts->save($update)) {
                    $this->Flash->success('Text Updated successfully');
                    $this->redirect(HTTP_ROOT.'admin/users/text');
                }
            }
        }

    }

    public function clientTestimonial()
    {
        $this->set('title','Client Testimonials');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('ClientTestimonials');

        $this->paginate = array('limit'=>'10');
        $txts = $this->paginate($this->ClientTestimonials->find()
                    ->hydrate(false));
        $txt =$txts->toArray();
        $this->set('txt',$txt);
        
    }
     public function addTestimonial()
     {
        $this->set('title','Add Testimonials');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('ClientTestimonials');
        $this->loadComponent('Resize');
        if ($this->request->is('post')) {
            $data = $this->request->data; //prx($data);
            if (!empty($data)) {
                $target = '../webroot/img/testimonialImg';
                if (!empty($_FILES['image']['name'])) {
                    $image_name = pathinfo($_FILES['image']['name']);
                    $ext = $image_name['extension'];
                    $new_image = rand(4,10000);
                    $img_name = $new_image.'.'.$ext;//prx($img_name);
                    $targetpath = realpath($target).'/'.$img_name;//prx($targetpath);
                    $source = $_FILES['image']['tmp_name'];
                    if(is_uploaded_file($source)) {
                        //move_uploaded_file($source, $targetpath);
                        $this->Resize->resize($source,$targetpath,'aspect_fill',250,250,0,0,0,0);
                        if (file_exists('../webroot/img/testimonialImg/'.$data['old_image'])) {
                            @unlink('../webroot/img/testimonialImg/'.$data['old_image']);
                        }
                        $data['ClientTestimonials']['image'] = $img_name;

                    }
                }
                unset($data['image']);
                $getdata = $this->ClientTestimonials->newEntity($data);
                $getdata['ClientTestimonials']['created'] = date("Y-m-d H:i:s");
                if ($this->ClientTestimonials->save($getdata)) {
                    $this->Flash->success('Testimonials Added Successfully');
                    $this->redirect(HTTP_ROOT.'admin/users/clientTestimonial');

                }
            }
        }

     }
    public function editTestimonial($id = null)
    {
       $this->set('title','Edit Testimonials'); 
       $this->viewBuilder()->layout('admin_dashboard');
       $this->loadComponent('Resize');
       $this->loadModel('ClientTestimonials');
       $id = $this->Utility->decode($id); 
       $client = $this->ClientTestimonials->find()
                ->where(['id'=>$id])
                ->hydrate(false)
                ->first();
        $this->set('client',$client);

        if ($this->request->is('post')) {
            $data = $this->request->data;
            if (!empty($data)) {
                $target = '../webroot/img/testimonialImg';
                if (!empty($_FILES['image']['name'])) {
                    $image_name = pathinfo($_FILES['image']['name']);
                    $ext = $image_name['extension'];
                    $new_image = rand(4,10000);
                    $img_name = $new_image.'.'.$ext;//prx($img_name);
                    $targetpath = realpath($target).'/'.$img_name;//prx($targetpath);
                    $source = $_FILES['image']['tmp_name'];
                    if(is_uploaded_file($source)) {
                        //move_uploaded_file($source, $targetpath);
                        $this->Resize->resize($source,$targetpath,'aspect_fill',250,250,0,0,0,0);
                        if (file_exists('../webroot/img/testimonialImg/'.$data['old_image'])) {
                            @unlink('../webroot/img/testimonialImg/'.$data['old_image']);
                        }
                        $data['ClientTestimonials']['image'] = $img_name;

                    }
                }
                unset($data['image']);
                $getdata = $this->ClientTestimonials->newEntity($data); //prx($data);
                $getdata['ClientTestimonials']['created'] = date("Y-m-d H:i:s");
                if ($this->ClientTestimonials->save($getdata)) {
                    $this->Flash->success('Testimonials Updated Successfully');
                    $this->redirect(HTTP_ROOT.'admin/users/clientTestimonial');

                }
            }
        }
    } 

    public function slideManagemnt()
    {
        $this->set('title','slide Management');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('Sliders');

        $this->paginate = array('limit'=>'10');
        $txts = $this->paginate($this->Sliders->find()
                    ->hydrate(false));
        $slide =$txts->toArray();
        $this->set('slide',$slide);
    }

    public function editslideManagemnt($id = null)
    {
       $this->set('title','Edit Slider Management'); 
       $this->viewBuilder()->layout('admin_dashboard');
       $this->loadComponent('Resize');
       $this->loadModel('Sliders');
       $id = $this->Utility->decode($id); 
       $client = $this->Sliders->find()
                ->where(['id'=>$id])
                ->hydrate(false)
                ->first();
        $this->set('client',$client);

        if ($this->request->is('post')) {
            $data = $this->request->data; 
            if (!empty($data)) {
                $target = '../webroot/img/sliderImg';
                if (!empty($_FILES['image']['name'])) {
                    $image_name = pathinfo($_FILES['image']['name']);
                    $ext = $image_name['extension'];
                    $new_image = rand(4,10000);
                    $img_name = $new_image.'.'.$ext;//prx($img_name);
                    $targetpath = realpath($target).'/'.$img_name;//prx($targetpath);
                    $source = $_FILES['image']['tmp_name'];
                    if(is_uploaded_file($source)) {
                        //move_uploaded_file($source, $targetpath);
                        $this->Resize->resize($source,$targetpath,'aspect_fill',1900,880,0,0,0,0);
                        if (file_exists('../webroot/img/sliderImg/'.$data['old_image'])) {
                            @unlink('../webroot/img/sliderImg/'.$data['old_image']);
                        }
                        $data['Sliders']['image'] = $img_name;

                    }
                }
                unset($data['image']);
                $getdata = $this->Sliders->newEntity($data); //prx($data);
                $getdata['Sliders']['created'] = date("Y-m-d H:i:s");
                if ($this->Sliders->save($getdata)) {
                    $this->Flash->success('Sliders Updated Successfully');
                    $this->redirect(HTTP_ROOT.'admin/users/slideManagemnt');

                }
            }
        }
    }

    public function ourPartner()
    {
       $this->set('title','Our Partner Management');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('OurPartners');

        $this->paginate = array('limit'=>'10');
        $txts = $this->paginate($this->OurPartners->find()
                    ->hydrate(false));
        $partner =$txts->toArray();
        $this->set('partner',$partner); 
    }

    public function addPartner()
    {
      $this->set('title','Add Partner');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('OurPartners');
        $this->loadComponent('Resize');
        if ($this->request->is('post')) {
            $data = $this->request->data; //prx($data);
            if (!empty($data)) {
                $target = '../webroot/img/parnterImg';
                if (!empty($_FILES['image']['name'])) {
                    $image_name = pathinfo($_FILES['image']['name']);
                    $ext = $image_name['extension'];                    $new_image = rand(4,10000);
                    $img_name = $new_image.'.'.$ext;//prx($img_name);
                    $targetpath = realpath($target).'/'.$img_name;//prx($targetpath);
                    $source = $_FILES['image']['tmp_name'];
                    if(is_uploaded_file($source)) {
                        move_uploaded_file($source, $targetpath);
                        //$this->Resize->resize($source,$targetpath,'aspect_fill',250,250,0,0,0,0);
                        if (file_exists('../webroot/img/parnterImg/'.$data['old_image'])) {
                            @unlink('../webroot/img/parnterImg/'.$data['old_image']);
                        }
                        $data['OurPartners']['image'] = $img_name;

                    } 
                }
                unset($data['image']);
                $getdata = $this->OurPartners->newEntity($data);
                $getdata['OurPartners']['created'] = date("Y-m-d H:i:s");
                if ($this->OurPartners->save($getdata)) {
                    $this->Flash->success('Partner Added Successfully');
                    $this->redirect(HTTP_ROOT.'admin/users/ourPartner');

                }
            }
        } 
    }

    public function editOurPartner($id = null)
    {
        $this->set('title','Edit Our Partner'); 
       $this->viewBuilder()->layout('admin_dashboard');
       $this->loadComponent('Resize');
       $this->loadModel('OurPartners');
       $id = $this->Utility->decode($id); 
       $client = $this->OurPartners->find()
                ->where(['id'=>$id])
                ->hydrate(false)
                ->first();
        $this->set('client',$client);

        if ($this->request->is('post')) {
            $data = $this->request->data;
            if (!empty($data)) {
                $target = '../webroot/img/parnterImg';
                if (!empty($_FILES['image']['name'])) {
                    $image_name = pathinfo($_FILES['image']['name']);
                    $ext = $image_name['extension'];
                
                    $new_image = rand(4,10000);
                    $img_name = $new_image.'.'.$ext;//prx($img_name);
                    $targetpath = realpath($target).'/'.$img_name;//prx($targetpath);
                    $source = $_FILES['image']['tmp_name'];
                    if(is_uploaded_file($source)) {
                        move_uploaded_file($source, $targetpath);
                        //$this->Resize->resize($source,$targetpath,'aspect_fill',250,250,0,0,0,0);
                        if (file_exists('../webroot/img/parnterImg/'.$data['old_image'])) {
                            @unlink('../webroot/img/parnterImg/'.$data['old_image']);
                        }
                        $data['OurPartners']['image'] = $img_name;

                    }
                    
                }
                unset($data['image']);
                $getdata = $this->OurPartners->newEntity($data); //prx($data);
                $getdata['OurPartners']['created'] = date("Y-m-d H:i:s");
                if ($this->OurPartners->save($getdata)) {
                    $this->Flash->success('Our Partner Updated Successfully');
                    $this->redirect(HTTP_ROOT.'admin/users/ourPartner');

                }
            }
        }
    }
      public function viewUserManagement($id = null)
      {
        $this->set('title','view User Management');
        $this->viewBuilder()->layout('admin_dashboard');
        $id = $this->Utility->decode($id);//prx($id);
        $this->loadModel('Users');
        $this->loadModel('Countries');
        $user = $this->Users->find()->contain('Countries')->where(['Users.id'=>$id])->hydrate(false)->first();
        $this->set(compact('user'));//prx($user);

      } 

      public function  editUserManagement($id = null)
      {
        $this->set('title','Edit Users Management');
        $this->viewBuilder()->layout('admin_dashboard');
        $id = $this->Utility->decode($id);//prx($id);
        $this->loadModel('Users');
        $this->loadModel('Countries');
        $user = $this->Users->find()->contain('Countries')->where(['Users.id'=>$id])->hydrate(false)->first();
        $this->set(compact('user'));//prx($user);
        $countries = $this->Countries->find()->hydrate(false)->toArray();
        $this->set(compact('countries'));
        if($this->request->is('post')) {
            $data = $this->request->data; 
            if (!empty($data)) {
                $target = '../webroot/img/profilePic';
                if (!empty($_FILES['image']['name'])) {
                    $image_name = pathinfo($_FILES['image']['name']);
                    $ext = $image_name['extension'];
                
                    $new_image = rand(4,10000);
                    $img_name = $new_image.'.'.$ext;//prx($img_name);
                    $targetpath = realpath($target).'/'.$img_name;//prx($targetpath);
                    $source = $_FILES['image']['tmp_name'];
                    if(is_uploaded_file($source)) {
                        //move_uploaded_file($source, $targetpath);
                        $this->Resize->resize($source,$targetpath,'aspect_fill',250,250,0,0,0,0);
                        if (file_exists('../webroot/img/profilePic/'.$data['old_image'])) {
                            @unlink('../webroot/img/profilePic/'.$data['old_image']);
                        }
                        $data['Users']['image'] = $img_name;

                    }
                    
                }
                unset($data['image']);
                $getdata = $this->Users->newEntity($data); //prx($data);
                $getdata['Users']['created'] = date("Y-m-d H:i:s");
                if ($this->Users->save($getdata)) {
                    $this->Flash->success('User Management Updated Successfully');
                    $this->redirect(HTTP_ROOT.'admin/users/userManagement');

                }
            }
            
        }
      
    }
    
    public function membershipPlan()
    {
        $this->set('title','Membership Plan');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('MembershipPlans');
        $this->paginate = array('limit'=>'10');
        $mem = $this->paginate($this->MembershipPlans->find()->hydrate(false));
        $member = $mem->toArray(); 
        
        $this->set(compact('member'));
    }
    public function editMembershipPlan($id = null)
    {
        $this->set('title','Membership Plan');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('MembershipPlans');
        $id = $this->Utility->decode($id);
        $member = $this->MembershipPlans->find()->where(['id'=>$id])->hydrate(false)->first();
        $this->set(compact('member'));
        if ($this->request->is('post')) {
            $data = $this->request->data; 
            if (!empty($data)) {
                $getdata = $this->MembershipPlans->newEntity($data);
                if ($this->MembershipPlans->save($getdata)) {
                    $this->Flash->success('Membership plan Updated  Successfully');
                    $this->redirect(HTTP_ROOT.'admin/users/membershipPlan');

                }

            }
        }
    }


     public function country()
    {
        $this->set('title','Countries');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('Countries');
        $this->paginate = array('limit'=>'15');
        $count = $this->paginate($this->Countries->find()->hydrate(false));
        $country = $count->toArray();
        $this->set(compact('country'));//prx($country);
    }

    public function editCountry($id = null)
    {
        $this->set('title','Edit Countries');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('Countries');
        $id = $this->Utility->decode($id);
        $country = $this->Countries->find()->where(['id'=>$id])->hydrate(false)->first();
        
        $this->set(compact('country'));//prx($country);
        if ($this->request->is('post')) {
            $data = $this->request->data;
            if (!empty($data)) {
                $getdata = $this->Countries->newEntity($data);
                if ($this->Countries->save($getdata)) {
                    $this->Flash->success('Country Updated Successfully');
                    $this->redirect(HTTP_ROOT.'admin/Users/country');
                }
            }

        }
    }

    public function addCountry()
    {
        $this->set('title','Add Countries');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('Countries');
        if ($this->request->is('post')) {
            $data = $this->request->data; 
            if (!empty($data)) {
                $getdata = $this->Countries->newEntity($data);
                if ($this->Countries->save($getdata)) {
                    $this->Flash->success('Country Name Added Successfully');
                    $this->redirect(HTTP_ROOT.'admin/Users/country');
                }
            }

        }
    }
    public function state()
    {
        $this->set('title','state');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('States');
        $this->loadModel('Countries');
        $this->paginate = array('limit'=>'15');
        $stat = $this->paginate($this->States->find()->hydrate(false));
        $state = $stat->toArray();
        $this->set(compact('state'));
    }

    public function addState()
    {
        $this->set('title','Add State');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('States');
        $this->loadModel('Countries');
        $countries = $this->Countries->find()->hydrate(false)->toArray();
        $this->set(compact('countries'));
        if ($this->request->is('post')) {
            $data = $this->request->data; 
            if (!empty($data)) {
                $getdata = $this->States->newEntity($data);
                if ($this->States->save($getdata)) { 
                    $this->Flash->success('States Name Added Successfully');
                    $this->redirect(HTTP_ROOT.'admin/Users/state');
                }
            }

        }
    }

    public function editState($id = null)
    {
        $this->set('title','Edit States');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('Countries');
        $this->loadModel('States');
        $id = $this->Utility->decode($id);
        $state = $this->States->find()->where(['id'=>$id])->hydrate(false)->first();
        $countries = $this->Countries->find()->hydrate(false)->toArray();
        $this->set(compact('state','countries'));//prx($country);
        if ($this->request->is('post')) {
            $data = $this->request->data; 
            if (!empty($data)) {
                $getdata = $this->States->newEntity($data);
                if ($this->States->save($getdata)) {
                    $this->Flash->success('States Updated Successfully');
                    $this->redirect(HTTP_ROOT.'admin/Users/state');
                }
            }

        }
    }

    public function cities()
    {
        $this->set('title','City');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('Cities');
        $this->paginate  = array('limit'=>'15');
        $city = $this->paginate($this->Cities->find()->hydrate(false));
        $cities = $city->toArray();
        $this->set(compact('cities'));
    }

     public function addCities()
    {    

        $this->set('title','Add Cities');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('States');
        $this->loadModel('Countries');
        $this->loadModel('Cities');
        $countries = $this->Countries->find()->hydrate(false)->toArray();
        $this->set(compact('countries'));
        if ($this->request->is('post')) {
            $data = $this->request->data; 
            if (!empty($data)) {
                $getdata = $this->Cities->newEntity($data);//prx($data);
                if ($this->Cities->save($getdata)) { 
                    $this->Flash->success('New Cities Added Successfully');
                    $this->redirect(HTTP_ROOT.'admin/Users/cities');
                }
            }

        }
    }

    public function editCities($id = null)
    {    

        $this->set('title','Edit Cities');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('States');
        $this->loadModel('Countries');
        $this->loadModel('Cities');
        $countries = $this->Countries->find()->hydrate(false)->toArray();
        $this->set(compact('countries'));
        $states = $this->States->find()->hydrate(false)->toArray();
        $this->set(compact('states'));
        $id = $this->Utility->decode($id); 
        $city = $this->Cities->find()->contain(['States'])->where(['Cities.id'=>$id])->hydrate(false)->first();
        $this->set(compact('city'));
        if ($this->request->is('post')) {
            $data = $this->request->data; 
            if (!empty($data)) {
                $getdata = $this->Cities->newEntity($data);//prx($data);
                if ($this->Cities->save($getdata)) { 
                    $this->Flash->success('Cities  Updated Successfully');
                    $this->redirect(HTTP_ROOT.'admin/Users/cities');
                }
            }

        }
    }
    
    public function getState($countryId = null)   {
        $this->loadModel('States');
        $stateInfo = $this->States->find()
        ->where(['country_id'=>$countryId,'status' =>'Active'])
        ->hydrate(false)
        ->toArray();
        echo json_encode($stateInfo);
        die;
    }

    public function aboutUs()
    {
        $this->set('title','About Us ');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('AboutUs');
        $about = $this->AboutUs->find()->hydrate(false)->toArray();
        $this->set(compact('about'));
    }

    public function editAboutUs($id =null)
    {

        $this->set('title','Edit About Us ');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('AboutUs'); 
        $id = $this->Utility->decode($id);
        $about = $this->AboutUs->find()
            ->where(['AboutUs.id'=>$id])
            ->hydrate(false)
            ->first();
        $this->set('about',$about);//prx($about);
        if ($this->request->is('post')) {
            $data = $this->request->data; 
            if (!empty($data)) {
                $targetpath = '../webroot/img/aboutUsImg';
                if(!empty($_FILES['image']['name'])) { 
                    $image_name = pathinfo($_FILES['image']['name']);
                    $ext = $image_name['extension'];
                        $new_image = rand(4,10000);
                        $target = realpath($targetpath).'/';
                        $img_name = $new_image.'.'.$ext;
                        $source = $_FILES['image']['tmp_name'];
                        $this->loadComponent('Resize');

                    if(is_uploaded_file($_FILES['image']['tmp_name'])) {
                        
                        $this->Resize->resize($source,$target.$img_name,'aspect_fill',545,286,0,0,0,0);
                        //move_uploaded_file($_FILES['image']['tmp_name'], $target.$img_name);
                        if(file_exists($target.$data['old_image'])) {
                            @unlink('../webroot/img/aboutUsImg/'.$data['old_image']);
                        }
                        $data['AboutUs']['image'] = $img_name;
                    }    
                } 
                unset($data['image']);
                $getData = $this->AboutUs->newEntity($data);
                if($this->AboutUs->save($getData)) {
                    $this->redirect(HTTP_ROOT.'admin/users/aboutUs');
                }
            }
        }
    }

     public function ourTeamMember()
    {
       $this->set('title','Our Team Member ');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('OurTeams');
        $this->paginate = array('limit'=>'10');
        $our = $this->paginate($this->OurTeams->find()->hydrate(false));
        $ourteam = $our->toArray();
        $this->set(compact('ourteam'));
    }

    public function editOurTeam($id =null)
    {
     $this->set('title','Edit Our Team');
     $this->viewBuilder()->layout('admin_dashboard');
     $this->loadModel('OurTeams');
     $id = $this->Utility->decode($id);
     $about = $this->OurTeams->find()->where(['id'=>$id])->hydrate(false)->first();
     $this->set(compact('about'));
     if ($this->request->is('post')) {
            $data = $this->request->data;
            if (!empty($data)) {
                $targetpath = '../webroot/img/teamImg';
                if(!empty($_FILES['image']['name'])) { 
                    $image_name = pathinfo($_FILES['image']['name']);
                    $ext = $image_name['extension'];
                    if(($ext != 'jpg') && ($ext != 'png') && ($ext != 'jpeg') && ($ext != 'gif')) {
                    
                        $this->loadComponent('Flash');
                        $this->Flash->error('Please Upload JPG,PNG,GIF Format Image');
                        return $this->redirect(  
                                $this->referer()
                            );
                        exit();
                    } else {
                        list($width, $height) = getimagesize($_FILES['image']['tmp_name']);
                    
                        if((int)$width < 250 && (int)$height < 250 ) {
                            $this->Flash->error('Please upload image of 250x250px');
                            return $this->redirect(array(
                             'action' => 'ourTeamMember'
                            ));
                            exit;
                        }
                        if($_FILES['image']['size'] > 6000000) {
                            $this->Flash->error('Image size too large, please upload less then 6 MB');
                            return $this->redirect(array(
                             'action' => 'ourTeamMember'
                            ));
                            exit;
                        }
                        $new_image = rand(4,10000);
                        $target = realpath($targetpath).'/';
                        $img_name = $new_image.'.'.$ext;
                        $source = $_FILES['image']['tmp_name'];
                        $this->loadComponent('Resize');

                        if(is_uploaded_file($_FILES['image']['tmp_name'])) {
                        
                            $this->Resize->resize($source,$target.$img_name,'aspect_fill',250,250,0,0,0,0);
                            //move_uploaded_file($_FILES['image']['tmp_name'], $target.$img_name);
                            if(file_exists($target.$data['old_image'])) {
                                @unlink('../webroot/img/teamImg/'.$data['old_image']);
                            }
                            $data['OurTeams']['image'] = $img_name; 
                        }
                    }    
                }
                unset($data['image']);
                
                $getData = $this->OurTeams->newEntity($data); 
                if($this->OurTeams->save($getData)) {
                    $this->redirect(HTTP_ROOT.'admin/users/ourTeamMember');
                } 
                
            }
            
        }

    }
    public function reviewAndRating()
    {
        $this->set('title','Friendoz | Reviews And Rating');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('Reviews');
        $this->paginate = array('limit'=>'10');
        $rat = $this->paginate($this->Reviews->find()->contain(['Users'=>['fields'=>['id','user_name']],'RatedUser'=>['fields'=>['id','user_name']]])->order(['Reviews.id'=>'DESC'])->hydrate(false));
        $reviews = $rat->toArray(); 
        $this->set(compact('reviews'));
    }
    public function viewReviewAndRating($id = null)
    {
        $this->set('title','Friendoz | View Reviews And Rating');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('Reviews');
        $id = $this->Utility->decode($id);
        $rat = $this->Reviews->find()->contain(['Users'=>['fields'=>['id','user_name']],'RatedUser'=>['fields'=>['id','user_name']]])->where(['Reviews.id'=>$id])->order(['Reviews.id'=>'DESC'])->hydrate(false);
        $user = $rat->first(); 
        $this->set(compact('user'));
    }

    public function contactUs()
    {
        $this->set('title','Contact Us');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('Contacts');
        $this->paginate = array('limit'=>'15');
        $contactInfo = $this->paginate($this->Contacts->find()->order(['id'=>'desc']));
        $contactInfo = $contactInfo->toArray();
        $this->set(compact('contactInfo')); //prx($contactInfo);

        
    } 

    public function viewContactUs($id=null)
    {
        $this->set('title','Contact Us');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('Contacts');
        $id = $this->Utility->decode($id);
        $contactUser = $this->Contacts->messageInfo($id);
        $status = $contactUser;
        $this->set(compact('contactUser'));
        if($status['status'] == 'Unread'){
            $query = $this->Contacts->query();
            $query->update()->set(['status' => 'Read'])->where(['id' => $id])->execute();
        }
        $this->loadModel('AdminReplies');
        $admin_reply = $this->AdminReplies->find()
            ->where(['contact_id'=>$id])
            ->hydrate(false)
            ->toArray();
        $this->set(compact('admin_reply'));
      
    }

    public function contactUsReply($id = null)
    {
        $this->set('title','Contact Us');
        $this->viewBuilder()->layout('admin_dashboard');
        if( !empty($id)) {
            $id = $this->Utility->decode($id);
            $this->loadModel('Contacts');
            $userEmail = $this->Contacts->find()->where(['Contacts.id'=>$id])
                        ->hydrate(false)->first();
            $this->set('userEmail', $userEmail); 
            
        }

        if($this->request->is('post')) {
            $data = $this->request->data; //prx($data);
            $this->loadModel('Contacts');
            //$message =  $this->Contacts->savemessage($data); //prx($message);
            if (!empty($data)) {
                $info = $this->Contacts->newEntity($data);
                if ($this->Contacts->save($info)) {
                    $this->loadModel('AdminReplies');
                    $reply_info['contact_id'] = $info->id;
                    $reply_info['admin_reply'] = $info->admin_reply;
                    $info1 = $this->AdminReplies->newEntity($reply_info);
                    if ($this->AdminReplies->save($info1)) {
                        $postId = $info->id;
                        $this->sendContactUsReplyEmail($postId);
                        $this->loadComponent('Flash');
                        $this->Flash->success('Message Sent Successfully');
                        $this->redirect(HTTP_ROOT.'admin/users/contactUs');  
                    }

                }
            } 
            
        }   
    }

    public function sendContactUsReplyEmail($postId)
    {
       
        if (!empty($postId)) {
            $this->loadModel('Contacts');
           $template = TableRegistry::get('EmailTemplates'); 
            $emailTemp = $template->find()
            ->where(array(
                    'id' =>'9',
                )
            );
            $templateInfo = $emailTemp->first()->toArray(); 

            $memInfo = $this->Contacts->find()
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

    public function repotUsers()
    {
        $this->set('title','Friendoz | Report Users');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('ReportUsers'); 
        $this->paginate = array('limit'=>'10');
        $report = $this->paginate($this->ReportUsers->find()
            ->contain(['Users'=>['fields'=>['id','user_name','email']],'ReportTo'=>['fields'=>['id','user_name','email']]])
            ->hydrate(false));
        $reportUsers = $report->toArray();
        $this->set(compact('reportUsers'));
    }

    public function viewRepotUsers($id = null)
    {
        $this->set('title','Friendoz | View Report Users');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('ReportUsers');
        $id = $this->Utility->decode($id); 
        $report = $this->ReportUsers->find()
            ->contain(['Users'=>['fields'=>['id','user_name','email']],'ReportTo'=>['fields'=>['id','user_name','email']]])
            ->where(['ReportUsers.id'=>$id])
            ->hydrate(false);
        $user = $report->first();
        $this->set(compact('user'));  //prx($user);
    }

    public function sendEmailReportUsers($id = null)
    {
        $this->set('title','Friendoz | View Report Users');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('ReportUsers');
        $id = $this->Utility->decode($id); 
        $report = $this->ReportUsers->find()
            ->contain(['Users'=>['fields'=>['id','user_name','email']],'ReportTo'=>['fields'=>['id','user_name','email']]])
            ->where(['ReportUsers.id'=>$id])
            ->hydrate(false);
        $userEmail = $report->first();
        $this->set(compact('userEmail')); 

        if($this->request->is('post')) {
            $data = $this->request->data;
            $this->loadModel('ReportUsers');
            $emailId = $data['ReportUsers']['report_by'];
            $message = $data['ReportUsers']['message'];
            $postId = $data['ReportUsers']['id'];
            $this->loadModel('EmailTemplates');

            $template = TableRegistry::get('EmailTemplates'); 
            $emailTemp = $template->find()
            ->where(array(
                    'id' =>'10',
                )
            );
            $this->loadModel('Users');
            $templateInfo = $emailTemp->first()->toArray(); 

            $memInfo = $this->ReportUsers->find()
                ->contain(['Users'=>['fields'=>['id','user_name','email']]])
                ->where(array(
                        'ReportUsers.id' =>$postId,
                    )
                ); 
            $info = $memInfo->first()->toArray();
            $emailContent = $templateInfo['html_content']; 
            $emailContent = str_replace('../../../', HTTP_ROOT, $emailContent);
            $email        = new Email('default');
            $email->template('common_template','default');
            $email->emailFormat('html');
            $emailContent = str_replace('{[user_name]}', $info['ReportBy']['user_name'], $emailContent);
            $emailContent = str_replace('{[user_email]}', $emailId, $emailContent);
            $emailContent = str_replace('{[admin_reply]}', $message, $emailContent);
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
                    $email->to(trim($emailId));
                    $email->from($templateInfo['from_email']);
            $email->subject($templateInfo['subject']);
            if($email->send()) {
                $this->Flash->success('your mail send successfuly ');
                $this->redirect(HTTP_ROOT.'admin/users/repotUsers');
            }
            
            
        } 
    }
    
    public function privacyPolicy()
    {
        $this->set('title','Friendoz | Privacy & Policy');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('Cms');
        
        $cms = $this->Cms->find()->where(['id'=>1])->hydrate(false)->first();
        
        $this->set(compact('cms'));
    }

    public function editPrivacyPolicy($id = null)
    {
        $this->set('title','Friendoz | Edit Privacy & Policy');
        $this->viewBuilder()->layout('admin_dashboard');
        $this->loadModel('Cms'); 
        $id = $this->Utility->decode($id);
        $about = $this->Cms->find()->where(['Cms.id'=>$id])->hydrate(false)->first();
        $this->set(compact('about'));
        if ($this->request->is('post')) {
            $data = $this->request->data;
            if (!empty($data)) {
                $info = $this->Cms->newEntity($data);
                if ($this->Cms->save($info)){
                    $this->Flash->success('Privacy & Policy Updated Successfully');
                    $this->redirect(HTTP_ROOT.'admin/users/privacyPolicy');
                }
            }
        }

    }
} 
?>