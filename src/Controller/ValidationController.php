<?php 
namespace App\Controller;
use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\Time;
use Cake\ORM\Query;
use Cake\Mailer\Email;
ob_start();
    class ValidationController extends AppController
    {   
        function validateAdminLoginAjax()
        {
            $this->autoRender = false;
            if ($this->request->is('ajax')) {
                $errors_msg = null;
                $errors = $this->validateAdminLogin($this->request->data);

                // f ( is_array ( $this->data ) )
                    foreach($this->request->data as $key => $value) {
                        
                        if (array_key_exists($key, $errors)) {
                            foreach($errors[$key] as $k => $v) {
                                $errors_msg.= "error|$key|$v";
                            }
                        } else {
                            $errors_msg.= "ok|$key\n";
                        }
                    }               
                echo $errors_msg;
                die;
            }
        }

        
        function validateAdminLogin($data) 
        {
            $errors = array();
            if (trim($data['username']) == "") {
                $errors['username'][] = __('This field is required.') . "\n";
            } 
            if (trim($data['password']) == "") {
                $errors['password'][] = __('This field is required.') . "\n";
            }
            return $errors;
            die;
        }

        public function validateAdminEditAjax()
        {
                    
            if($this->request->is('ajax')) {
                $errors_msg = null;
                $data = $this->request->data;
                $errors = $this->validateAdminEdit($data);
                
                if( !empty($data)) {
                    foreach($data['Admins'] as $key => $value) {
                        if(array_key_exists($key, $errors)) {

                            foreach($errors[$key] as $k => $v) {
                                $errors_msg .= "error|$key|$v";
                            }   
                        } else {
                            $errors_msg .= "ok|$key\n";
                        }
                    }
                }
                echo $errors_msg;exit;
            }   
        }
        
         
        public function validateAdminEdit($data)
        {
            $errors = array();
            if(trim($data['Admins']['firstname']) == "") {
                $errors['firstname'][] = __('This field is required.')."\n";
            }else if( !preg_match('/^[a-z]/i', trim($data['Admins']['firstname']))) { 
                    $errors['firstname'][] = "Please enter valid name"."\n";
                }

            if(trim($data['Admins']['lastname']) == "") {
                $errors['lastname'][] = __('This field is required.')."\n";
            }else if( !preg_match('/^[a-z]/i', trim($data['Admins']['lastname']))) { 
                    $errors['lastname'][] = "Please enter valid name"."\n";
                }

            if(trim($data['Admins']['username']) == "") {
                $errors['username'][] = __('This field is required.')."\n";
            }

            if(trim($data['Admins']['email']) == "") {
                $errors['email'][] = __('This field is required.')."\n";
            } else if($data['Admins']['email'] != "") {

                if($this->isValidEmail(trim($data['Admins']['email'])) == 'false') {
                    $errors['email'][] = __('Please enter valid email.')."\n";  
                }
            }
            
            return $errors;
            die;
        }

        function validateForgetPasswordAjax()
        {
            if ($this->request->is('ajax')) {
                $errors_msg = null;
                $data = $this->request->data;
                $errors = $this->validateForgetPassword($data);
                    {
                    foreach($data['Admins'] as $key => $value)
                        {
                        if (array_key_exists($key, $errors))
                            {
                            foreach($errors[$key] as $k => $v)
                                {
                                $errors_msg.= "error|$key|$v";
                                }
                            }
                          else
                            {
                            $errors_msg.= "ok|$key\n";
                            }
                        }
                    }

                echo $errors_msg;
                die;
            }
        }

        function validateForgetPassword($data)
        {

            $errors = array();
            $this->loadModel('Admins');
            $queryInfo = $this->Admins->find()
                    ->where(array(
                        'email' =>$data['Admins']['email'],
                        )
                    )
                    ->first();

            if (trim($data['Admins']['email']) == "")
            {
                $errors['email'][] = __('This field is required.') . "\n";
            }
             
            else if($data['Admins']['email'] != "") {

                if($this->isValidEmail(trim($data['Admins']['email'])) == 'false') {
                    $errors['email'][] = __('Please enter valid email.')."\n";  
                } else if(empty($queryInfo)) {
                    $errors['email'][] = "Please Enter Valid Email"."\n";
                }  
            } 
            return $errors;
            die;
        }

        public function validateResetPasswordAjax()
        {
                    
            if($this->request->is('ajax')) {
                $errors_msg = null;
                $data = $this->request->data;
                $errors=$this->validateResetPassword($data);

                if( !empty($data)) {
                    foreach($data['Admins'] as $key => $value) {
                        if(array_key_exists($key, $errors)) {

                            foreach($errors[$key] as $k => $v) {
                                $errors_msg .= "error|$key|$v";
                            }   
                        } else {
                            $errors_msg .= "ok|$key\n";
                        }
                    }
                }

                echo $errors_msg;
                die;
            }
        }
           
        public function validateResetPassword($data)
        {

            if(trim($data['Admins']['password']) == "") {
                $errors['password'][] = __('This field is required.')."\n";
            }

            if(trim($data['Admins']['confirm']) == "") {
                $errors['confirm'][] = __('This field is required.')."\n";
            }

            if(!empty($data['Admins']['password'])) {
                    if(trim($data['Admins']['password']) !== trim($data['Admins']['confirm'])) {
                    $errors['password'][] = __('Password does Not matched.')."\n";
                }   
            }

            return $errors;
            die;
        }

        public function validatechangePasswordAjax()
        {          
            if($this->request->is('ajax')) {
                $errors_msg = null;
                $data = $this->request->data;
                $errors=$this->validateChangePassword($data);

                if( !empty($data)) {
                    foreach($data['Admins'] as $key => $value) {
                        if(array_key_exists($key, $errors)) {

                            foreach($errors[$key] as $k => $v) {
                                $errors_msg .= "error|$key|$v";
                            }   
                        } else {
                            $errors_msg .= "ok|$key\n";
                        }
                    }
                }

                echo $errors_msg;
                die;
            }
        }

        public function validateChangePassword($data)
        {
            $errors = array();
            $admins = TableRegistry::get('Admins');
            $queryInfo = $admins
            ->find();
            $admin_profile = $queryInfo->first()->toArray();
            if(trim($data['Admins']['current_pass']) == "") {
                $errors['current_pass'][] = __('This field is required.')."\n";
            } elseif($data['Admins']['current_pass'] != $admin_profile['decode_password']) {
                $errors['current_pass'][] = __('Please Enter Valid Current Password .')."\n";
            }

            if(trim($data['Admins']['password']) == "") {
                $errors['password'][] = __('This field is required.')."\n";
            }

            if(trim($data['Admins']['retype_pass']) == "") {
                $errors['retype_pass'][] = __('This field is required.')."\n";
            }

            if(!empty($data['Admins']['password'])) {
                    if(trim($data['Admins']['password']) !== trim($data['Admins']['retype_pass'])) {
                    $errors['password'][] = __('Password does Not matched.')."\n";
                }   
            }

            return $errors;
            die;
        }

        public function validateeditEmailTemplateAjax()
        {         
            if($this->request->is('ajax')) {
                $errors_msg = null;
                $data = $this->request->data;
                $errors = $this->validateEditEmailTemplate($data);
                if( !empty($data)) {

                    foreach($data['EmailTemplates'] as $key => $value) {

                        if(array_key_exists($key, $errors)) {

                            foreach($errors[$key] as $k => $v) {
                                $errors_msg .= "error|$key|$v";
                            }   
                        } else {
                            $errors_msg .= "ok|$key\n";
                        }
                    }
                }
                echo $errors_msg;
                die;
            }
        }
           
        public function validateEditEmailTemplate($data)
        {
               
            $errors = array();
            
            if(trim($data['EmailTemplates']['from_name']) == "") {
                $errors['from_name'][] = __('This field is required.')."\n";
            }

            if(trim($data['EmailTemplates']['subject']) == "") {
                $errors['subject'][] = __('This field is required.')."\n";
            }
            
            if(trim($data['EmailTemplates']['from_email']) == "") {
                $errors['from_email'][] = __('This field is required.')."\n";
            } else if($data['EmailTemplates']['from_email'] != "") {
                if($this->isValidEmail(trim($data['EmailTemplates']['from_email'])) == 'false') {
                    $errors['from_email'][] = __('Please enter valid email.')."\n";  
                }
            }
            
            if(isset($data['EmailTemplates']['html_content']) && trim($data['EmailTemplates']['html_content']) == "") {
                $errors['html_content'][] = __('This field is required.')."\n";
            }
            
            return $errors;
            die;
        } 

        public function validatefaqsAjax()
        {        
            if($this->request->is('ajax')) {
                $errors_msg = null;
                $data = $this->request->data;
                $errors=$this->validateFaqs($data);
                
                if( !empty($data)) {

                    foreach ($data['Faqs'] as $key => $value ) {

                        if(array_key_exists($key, $errors)) {

                            foreach($errors[$key] as $k => $v) {
                                $errors_msg .= "error|$key|$v";
                            }

                        } else {
                            $errors_msg .= "ok|$key\n";
                        }

                    }

                }

                echo $errors_msg;
                die;
            }
        }
           
        public function validateFaqs($data)
        {
               
            $errors = array();
            if(trim($data['Faqs']['faq_category_id']) == "") {
                $errors['faq_category_id'][] = __('This field is required.')."\n";
            }
            if(trim($data['Faqs']['question']) == "") {
                $errors['question'][] = __('This field is required.')."\n";
            }
            if(trim($data['Faqs']['answer']) == "") {
                $errors['answer'][] = __('This field is required.')."\n";
            }

            return $errors;
            die;
       }

        public function validatefaqCategoryAjax()
        {        
            if($this->request->is('ajax')) {
                $errors_msg = null;
                $data = $this->request->data;
                $errors=$this->validateFaqCategory($data);
                
                if( !empty($data)) {

                    foreach ($data['FaqCategories'] as $key => $value ) {

                        if(array_key_exists($key, $errors)) {
                            foreach($errors[$key] as $k => $v) {
                                $errors_msg .= "error|$key|$v";
                            }
                        } else {
                            $errors_msg .= "ok|$key\n";
                        }
                    }
                }
                echo $errors_msg;
                die;
            }
        }
           
        public function validateFaqCategory($data)
        {
               
            $errors = array();
        
            if(trim($data['FaqCategories']['title']) == "") {
                $errors['title'][] = __('This field is required.')."\n";
            }else if( !preg_match('/^[a-z]/i', $data['FaqCategories']['title'])) { 
                $errors['title'][] = "Please enter valid name"."\n";
            }
            return $errors;
            die;
       }

      public function validateeditTextAjax()
    {
        if($this->request->is('ajax')) {
                $errors_msg = null;
                $data = $this->request->data;
                $errors=$this->validateeditText($data);
                
                if( !empty($data)) {

                    foreach ($data['Texts'] as $key => $value ) {

                        if(array_key_exists($key, $errors)) {

                            foreach($errors[$key] as $k => $v) {
                                $errors_msg .= "error|$key|$v";
                            }

                        } else {
                            $errors_msg .= "ok|$key\n";
                        }

                    }

                }

                echo $errors_msg;
                die;
            }   
    }
    public function validateeditText($data)
    {
           
        $errors = array();
            if(trim($data['Texts']['section']) == "") {
                $errors['section'][] = __('This field is required.')."\n";
            }
            if(trim($data['Texts']['title']) == "") {
                $errors['title'][] = __('This field is required.')."\n";
            }
            if(trim($data['Texts']['description']) == "") {
                $errors['description'][] = __('This field is required.')."\n";
            }
            if(trim($data['Texts']['description_two']) == "") {
                $errors['description_two'][] = __('This field is required.')."\n";
            }

            return $errors;
            die;
    }
    public function validateaddTestimonialAjax()
    {
        if($this->request->is('ajax')) {
                $errors_msg = null;
                $data = $this->request->data;
                $errors=$this->validateaddTestimonial($data);
                
                if( !empty($data)) {

                    foreach ($data['ClientTestimonials'] as $key => $value ) {

                        if(array_key_exists($key, $errors)) {

                            foreach($errors[$key] as $k => $v) {
                                $errors_msg .= "error|$key|$v";
                            }

                        } else {
                            $errors_msg .= "ok|$key\n";
                        }

                    }

                }

                echo $errors_msg;
                die;
            }   
    }
    public function validateaddTestimonial($data)
    {
           
        $errors = array();
        if(trim($data['ClientTestimonials']['name']) == "") {
            $errors['name'][] = __('This field is required.')."\n";
        }
        if(trim($data['ClientTestimonials']['section']) == "") {
            $errors['section'][] = __('This field is required.')."\n";
        }
        if(trim($data['ClientTestimonials']['description']) == "") {
            $errors['description'][] = __('This field is required.')."\n";
        }

        return $errors;
        die;
    }
    public function validateeditTestimonialAjax()
    {
        if($this->request->is('ajax')) {
                $errors_msg = null;
                $data = $this->request->data;
                $errors=$this->validateeditTestimonial($data);
                
                if( !empty($data)) {

                    foreach ($data['ClientTestimonials'] as $key => $value ) {

                        if(array_key_exists($key, $errors)) {

                            foreach($errors[$key] as $k => $v) {
                                $errors_msg .= "error|$key|$v";
                            }

                        } else {
                            $errors_msg .= "ok|$key\n";
                        }

                    }

                }

                echo $errors_msg;
                die;
            }   
    }
    public function validateeditTestimonial($data)
    {
           
        $errors = array();
        if(trim($data['ClientTestimonials']['name']) == "") {
            $errors['name'][] = __('This field is required.')."\n";
        }
        if(trim($data['ClientTestimonials']['section']) == "") {
            $errors['section'][] = __('This field is required.')."\n";
        }
        if(trim($data['ClientTestimonials']['description']) == "") {
            $errors['description'][] = __('This field is required.')."\n";
        }

        return $errors;
        die;
    }

    public function validateeditslideManagemntAjax()
    {
        if($this->request->is('ajax')) {
                $errors_msg = null;
                $data = $this->request->data;
                $errors=$this->validateeditslideManagemnt($data);
                
                if( !empty($data)) {

                    foreach ($data['Sliders'] as $key => $value ) {

                        if(array_key_exists($key, $errors)) {

                            foreach($errors[$key] as $k => $v) {
                                $errors_msg .= "error|$key|$v";
                            }

                        } else {
                            $errors_msg .= "ok|$key\n";
                        }

                    }

                }

                echo $errors_msg;
                die;
            }   
    }
    public function validateeditslideManagemnt($data)
    {
           
        $errors = array();
        if(trim($data['Sliders']['title']) == "") {
            $errors['title'][] = __('This field is required.')."\n";
        }
        // if(trim($data['ClientTestimonials']['title']) == "") {
        //     $errors['title'][] = __('This field is required.')."\n";
        // }
        // if(trim($data['Sliders']['description']) == "") {
        //     $errors['description'][] = __('This field is required.')."\n";
        // }

        return $errors;
        die;
    }
     public function validateeditUserManagementAjax()
    {
        if($this->request->is('ajax')) {
            $errors_msg = null;
            $data = $this->request->data;
            $errors=$this->validateeditUserManagement($data);

            if( !empty($data)) {
                foreach($data['Users'] as $key => $value) {
                    if(array_key_exists($key, $errors)) {

                        foreach($errors[$key] as $k => $v) {
                            $errors_msg .= "error|$key|$v";
                        }   
                    } else {
                        $errors_msg .= "ok|$key\n";
                    }
                }
            }

            echo $errors_msg;
            die;
        }
    }

    public function validateeditUserManagement($data)
    {
        $errors = array();
        if(trim($data['Users']['user_name']) == "") {
            $errors['user_name'][] = __('This field is required.')."\n";
        }
        if(trim($data['Users']['phone'])=="") {
            $errors['phone'][] = __('This field is required')."\n";
        }elseif(trim($data['Users']['phone'])!="") {
            if(!(is_numeric($data['Users']['phone']))) {
                $errors['phone'][] = "Enter numeric value only"."\n";
            }
            if(strlen(trim($data['Users']['phone'])) <7 || strlen(trim($data['Users']['phone'])) > 14 ){
                $errors['phone'][] = "Enter valid phone number"."\n";   
            }
        }

        if(trim($data['Users']['gender'])=="") {
            $errors['gender'][] = __('This field is required')."\n";
        }
        if(!empty($data['Users']['age'])) {
           if(!(is_numeric($data['Users']['age']))) {
                $errors['age'][] = "Enter numeric value only"."\n";
            } else if (strlen(trim($data['Users']['age'])) > 2) {
                    $errors['age'][] = "Please Enter Valid preferred age"."\n";
                }
        }

        if(trim($data['Users']['socal_status'])=="") {
            $errors['socal_status'][] = __('This field is required')."\n";
        }

        if(trim($data['Users']['search_criteria'])=="") {
            $errors['search_criteria'][] = __('This field is required')."\n";
        }

        if(trim($data['Users']['country_id'])=="") {
            $errors['country_id'][] = __('This field is required')."\n";
        }
        if(trim($data['Users']['description'])=="") {
            $errors['description'][] = __('This field is required')."\n";
        }
        // if(trim($data['Users']['abc'])=="") {
        //     $errors['abc'][] = __('This field is required')."\n";
        // }
        

        return $errors;
        die;
    }
    
    public function validateeditMembershipPlanAjax()
    {
        if($this->request->is('ajax')) {
            $errors_msg = null;
            $data = $this->request->data;
            $errors=$this->validateeditMembershipPlan($data);
            
            if( !empty($data)) {

                foreach ($data['MembershipPlans'] as $key => $value ) {

                    if(array_key_exists($key, $errors)) {

                        foreach($errors[$key] as $k => $v) {
                            $errors_msg .= "error|$key|$v";
                        }

                    } else {
                        $errors_msg .= "ok|$key\n";
                    }

                }

            }

            echo $errors_msg;
            die;
        }   
    }
    public function validateeditMembershipPlan($data)
    {
           
        $errors = array();
        if(trim($data['MembershipPlans']['name']) == "") {
            $errors['name'][] = __('This field is required.')."\n";
        }
        if(trim($data['MembershipPlans']['price']) == "") {
            $errors['price'][] = __('This field is required.')."\n";
        }elseif(!(is_numeric($data['MembershipPlans']['price']))) {
                $errors['price'][] = "Enter numeric value only"."\n";
            } 
        if(trim($data['MembershipPlans']['duration']) == "") {
            $errors['duration'][] = __('This field is required.')."\n";
        }

        return $errors;
        die;
    }

     public function validateeditCountryPlanAjax()
    {
        if($this->request->is('ajax')) {
                $errors_msg = null;
                $data = $this->request->data;
                $errors=$this->validateeditCountry($data);
                
                if( !empty($data)) {

                    foreach ($data['Countries'] as $key => $value ) {

                        if(array_key_exists($key, $errors)) {

                            foreach($errors[$key] as $k => $v) {
                                $errors_msg .= "error|$key|$v";
                            }

                        } else {
                            $errors_msg .= "ok|$key\n";
                        }

                    }

                }

                echo $errors_msg;
                die;
            }   
    }
    public function validateeditCountry($data)
    {
           
        $errors = array();
        $url =$data['Countries']['country_url'];
        if (trim($data['Countries']['country_name']) == "") {
            $errors['country_name'][] = __('This field is required.')."\n";
        }
        if (trim($data['Countries']['country_url']) == "") {
            $errors['country_url'][] = __('This field is required.')."\n";
        } 
        return $errors;
        die;
            
    }
    public function validateaddCountryAjax()
    {
        if($this->request->is('ajax')) {
                $errors_msg = null;
                $data = $this->request->data;
                $errors=$this->validateaddCountry($data);
                
                if( !empty($data)) {

                    foreach ($data['Countries'] as $key => $value ) {

                        if(array_key_exists($key, $errors)) {

                            foreach($errors[$key] as $k => $v) {
                                $errors_msg .= "error|$key|$v";
                            }

                        } else {
                            $errors_msg .= "ok|$key\n";
                        }

                    }

                }

                echo $errors_msg;
                die;
            }   
    }
    public function validateaddCountry($data)
    {
           
        $errors = array();
        $url =$data['Countries']['country_url'];
        if(trim($data['Countries']['country_name']) == "") {
            $errors['country_name'][] = __('This field is required.')."\n";
        }
        if (trim($data['Countries']['country_url']) == "") {
            $errors['country_url'][] = __('This field is required.')."\n";
        } 
        return $errors;
        die;
    }
     public function validateaddStateAjax()
    {
        if($this->request->is('ajax')) {
                $errors_msg = null;
                $data = $this->request->data;
                $errors=$this->validateaddState($data);
                
                if( !empty($data)) {

                    foreach ($data['States'] as $key => $value ) {

                        if(array_key_exists($key, $errors)) {

                            foreach($errors[$key] as $k => $v) {
                                $errors_msg .= "error|$key|$v";
                            }

                        } else {
                            $errors_msg .= "ok|$key\n";
                        }

                    }

                }

                echo $errors_msg;
                die;
            }   
    }
    public function validateaddState($data)
    {
           
        $errors = array();
        if(trim($data['States']['country_id']) == "") {
            $errors['country_id'][] = __('This field is required.')."\n";
        }
        if(trim($data['States']['state_name']) == "") {
            $errors['state_name'][] = __('This field is required.')."\n";
        }
        return $errors;
        die;
    }

     public function validateeditStateAjax()
    {
        if($this->request->is('ajax')) {
                $errors_msg = null;
                $data = $this->request->data;
                $errors=$this->validateeditState($data);
                
                if( !empty($data)) {

                    foreach ($data['States'] as $key => $value ) {

                        if(array_key_exists($key, $errors)) {

                            foreach($errors[$key] as $k => $v) {
                                $errors_msg .= "error|$key|$v";
                            }

                        } else {
                            $errors_msg .= "ok|$key\n";
                        }

                    }

                }

                echo $errors_msg;
                die;
            }   
    }
    public function validateeditState($data)
    {
           
        $errors = array();
        if(trim($data['States']['country_id']) == "") {
            $errors['country_id'][] = __('This field is required.')."\n";
        }
        if(trim($data['States']['state_name']) == "") {
            $errors['state_name'][] = __('This field is required.')."\n";
        }
        return $errors;
        die;
    }

     public function validateaddCitiesAjax()
    {
        if($this->request->is('ajax')) {
                $errors_msg = null;
                $data = $this->request->data;
                $errors=$this->validateaddCities($data);
                
                if( !empty($data)) {

                    foreach ($data['Cities'] as $key => $value ) {

                        if(array_key_exists($key, $errors)) {

                            foreach($errors[$key] as $k => $v) {
                                $errors_msg .= "error|$key|$v";
                            }

                        } else {
                            $errors_msg .= "ok|$key\n";
                        }

                    }

                }

                echo $errors_msg;
                die;
            }   
    }
    public function validateaddCities($data)
    {
           
        $errors = array();
        if(trim($data['Cities']['country_id']) == "") {
            $errors['country_id'][] = __('This field is required.')."\n";
        }
        if(trim($data['Cities']['state_id']) == "") {
            $errors['state_id'][] = __('This field is required.')."\n";
        }
        if (trim($data['Cities']['city_name']) == ""){
           $errors['city_name'][] = __('This field is required.')."\n";

        }
        return $errors;
        die;
    }

     public function validateeditCitiesAjax()
    {
        if($this->request->is('ajax')) {
                $errors_msg = null;
                $data = $this->request->data;
                $errors=$this->validateeditCities($data);
                
                if( !empty($data)) {

                    foreach ($data['Cities'] as $key => $value ) {

                        if(array_key_exists($key, $errors)) {

                            foreach($errors[$key] as $k => $v) {
                                $errors_msg .= "error|$key|$v";
                            }

                        } else {
                            $errors_msg .= "ok|$key\n";
                        }

                    }

                }

                echo $errors_msg;
                die;
            }   
    }
    public function validateeditCities($data)
    {
           
        $errors = array();
        if(trim($data['Cities']['country_id']) == "") {
            $errors['country_id'][] = __('This field is required.')."\n";
        }
        if(trim($data['Cities']['state_id']) == "") {
            $errors['state_id'][] = __('This field is required.')."\n";
        }
        if (trim($data['Cities']['city_name']) == ""){
           $errors['city_name'][] = __('This field is required.')."\n";

        }
        return $errors;
        die;
    }

    public function validateeditAboutUsAjax()
    {
        if($this->request->is('ajax')) {
            $errors_msg = null;
            $data = $this->request->data;
            $errors=$this->validateeditAboutUs($data);
            
            if( !empty($data)) {

                foreach ($data['AboutUs'] as $key => $value ) {

                    if(array_key_exists($key, $errors)) {

                        foreach($errors[$key] as $k => $v) {
                            $errors_msg .= "error|$key|$v";
                        }

                    } else {
                        $errors_msg .= "ok|$key\n";
                    }

                }

            }

            echo $errors_msg;
            die;
        }   
    }
    public function validateeditAboutUs($data)
    {
           
        $errors = array();
        if(trim($data['AboutUs']['title']) == "") {
            $errors['title'][] = __('This field is required.')."\n";
        }
        if(trim($data['AboutUs']['sub_title']) == "") {
            $errors['sub_title'][] = __('This field is required.')."\n";
        }
        // if (trim($data['AboutUs']['description']) == ""){
        //    $errors['description'][] = __('This field is required.')."\n";

        // }
        return $errors;
        die;
    }

     public function validateeditOurTeamAjax()
    {
        if($this->request->is('ajax')) {
            $errors_msg = null;
            $data = $this->request->data;
            $errors=$this->validateeditOurTeam($data);
            
            if( !empty($data)) {

                foreach ($data['OurTeams'] as $key => $value ) {

                    if(array_key_exists($key, $errors)) {

                        foreach($errors[$key] as $k => $v) {
                            $errors_msg .= "error|$key|$v";
                        }

                    } else {
                        $errors_msg .= "ok|$key\n";
                    }

                }

            }

            echo $errors_msg;
            die;
        }   
    }
    public function validateeditOurTeam($data)
    {
           
        $errors = array();
        if(trim($data['OurTeams']['name']) == "") {
            $errors['name'][] = __('This field is required.')."\n";
        }
        if(trim($data['OurTeams']['designation']) == "") {
            $errors['designation'][] = __('This field is required.')."\n";
        }
        // if (trim($data['OurTeams']['description']) == ""){
        //    $errors['description'][] = __('This field is required.')."\n";

        // }
        return $errors;
        die;
    }
    public function validateContactUsReplyAjax()
    {
                
        if($this->request->is('ajax')) {
            $errors_msg = null;
            $data = $this->request->data;
            $errors=$this->validateConatctUsReply($data);
            if ( !empty(  $data ) ) {
                foreach($data['Contacts'] as $key => $value ) {
                    if(array_key_exists ( $key, $errors) ) {
                        foreach ( $errors [ $key ] as $k => $v ) {
                            $errors_msg .= "error|$key|$v";
                        }   
                    } else {
                        $errors_msg .= "ok|$key\n";
                    }
                }
            }
            echo $errors_msg;
            die;
        }
    }
       
    public function validateConatctUsReply($data) 
    {
        $errors = array();
        
        if(trim($data['Contacts']['admin_reply']) == "") {
            $errors['admin_reply'][] = __('This field is required.')."\n";
        }
        
        return $errors;
        die;
    }
    
    public function validateeditPrivacyPolicyAjax()
    {
        if($this->request->is('ajax')) {
                $errors_msg = null;
                $data = $this->request->data;
                $errors=$this->validateeditPrivacyPolicy($data);
                
                if( !empty($data)) {

                    foreach ($data['Cms'] as $key => $value ) {

                        if(array_key_exists($key, $errors)) {

                            foreach($errors[$key] as $k => $v) {
                                $errors_msg .= "error|$key|$v";
                            }

                        } else {
                            $errors_msg .= "ok|$key\n";
                        }

                    }

                }

                echo $errors_msg;
                die;
            }   
    }
    public function validateeditPrivacyPolicy($data)
    {
           
        $errors = array();
        if(trim($data['Cms']['title']) == "") {
            $errors['title'][] = __('This field is required.')."\n";
        }
        
        // if (trim($data['Cms']['description']) == ""){
        //    $errors['description'][] = __('This field is required.')."\n";

        // }
        return $errors;
        die;
    }

       /********************* Front Side Validation Here ************************/

    public function validateUserRegisterAjax()
    {    
        if($this->request->is('ajax')) {
            $errors_msg = null;
            $data = $this->request->data;
            $errors=$this->validateUserRegister($data);

            if( !empty($data)) {
                foreach($data['Users'] as $key => $value) {
                    if(array_key_exists($key, $errors)) {

                        foreach($errors[$key] as $k => $v) {
                            $errors_msg .= "error|$key|$v";
                        }   
                    } else {
                        $errors_msg .= "ok|$key\n";
                    }
                }
            }

            echo $errors_msg;
            die;
        }
    }
       
    public function validateUserRegister($data)
    {
        $errors = array();
        $this->loadModel('Users');
        $email_exist = $this->Users->find()
            ->where(['email'=>$data['Users']['email']])
            ->count();
        if(trim($data['Users']['user_name']) == "") {
            $errors['user_name'][] = __('This field is required.')."\n";
        } else if( !preg_match('/^[a-z]/i', $data['Users']['user_name'])) { 
                $errors['user_name'][] = "Please enter valid name"."\n";
            }
        
        if (trim($data['Users']['email']) == "")
        {
            $errors['email'][] = __('This field is required.') . "\n";
        } else if($data['Users']['email'] != "") {

            if($this->isValidEmail(trim($data['Users']['email'])) == 'false') {
                $errors['email'][] = __('Please enter valid email.')."\n";  
            }
        }
        if($email_exist>=1) {
            $errors['email'][] = "Email Already Exist"."\n";
        }
        if(trim($data['Users']['password']) == "") {
            $errors['password'][] = __('This field is required.')."\n";
        }
        if(!empty($data['Users']['password'])) {
                if(trim($data['Users']['password']) !== trim($data['Users']['confirm_password'])) {
                $errors['confirm_password'][] = __('Confirm Password do not match.')."\n";
            }   
        }

        if(trim($data['Users']['confirm_password']) == "") {
            $errors['confirm_password'][] = __('This field is required.')."\n";
        }

       
        if(trim($data['Users']['phone'])=="") {
            $errors['phone'][] = __('This field is required')."\n";
        }elseif(trim($data['Users']['phone'])!="") {
            if(!(is_numeric($data['Users']['phone']))) {
                $errors['phone'][] = "Enter numeric value only"."\n";
            }
            if(strlen($data['Users']['phone']) <7 || strlen($data['Users']['phone']) > 14 ){
                $errors['phone'][] = "Enter valid phone number"."\n";   
            }
        }

        if(trim($data['Users']['gender'])=="") {
            $errors['gender'][] = __('This field is required')."\n";
        }

        if(trim($data['Users']['socal_status'])=="") {
            $errors['socal_status'][] = __('This field is required')."\n";
        }

        if(trim($data['Users']['search_criteria'])=="") {
            $errors['search_criteria'][] = __('This field is required')."\n";
        }

        if(trim($data['Users']['country_id'])=="") {
            $errors['country_id'][] = __('This field is required')."\n";
        }
        if(!empty($data['Users']['age'])) {
           if(!(is_numeric($data['Users']['age']))) {
                $errors['age'][] = "Enter numeric value only"."\n";
            } else if (strlen($data['Users']['age']) > 2) {
                $errors['age'][] = "Please Enter Valid preferred age"."\n";
            }
        }
         
        if(trim($data['Users']['term'])=="") {
            $errors['term'][] = __('Please check the checkbox')."\n";
        }
        return $errors;
        die;
    }

    function validateLoginAjax()
    {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $errors_msg = null;
            $errors = $this->validateLogin($this->request->data);
                foreach($this->request->data as $key => $value) {
                    
                    if (array_key_exists($key, $errors)) {

                        foreach($errors[$key] as $k => $v) {
                            $errors_msg.= "error|$key|$v";
                        }
                    } else {
                        $errors_msg.= "ok|$key\n";
                    }
                }               
            echo $errors_msg;
            die;
        }
    }

    
    function validateLogin($data) 
    {
        $errors = array();
        $users = $this->loadModel('Users');
        $user_info = $users->find()
            ->where(['email'=>$data['email'],'decode_password'=>$data['password']])
            ->hydrate('false')
            ->first();
        $userId = $this->Utility->encode($user_info['id']); 
        $uid = base64_encode(convert_uuencode($user_info['id']));
        $email = sha1($user_info['email']);
        $link1 = '<a href="'.HTTP_ROOT.'validation/userRegMail/'. $uid . '/' . $email .'">Email Verify</a>';  
        $userInfo = sizeof($user_info);
        if ($userInfo < 1) {
                $errors['password'][] = __('Username or Password is invalid')."\n";
            }
        if (trim($data['email']) == "") {
            $errors['email'][] = __('This field is required.') . "\n";
        } elseif($this->isValidEmail(trim($data['email'])) == 'false') {
                $errors['email'][] = __('Please enter valid email.')."\n";  
            }
        if (trim($data['password']) == "") {
            $errors['password'][] = __('This field is required.') . "\n";
        } else if(trim($user_info['status']) =="Inactive") {
            $errors['password'][] = 'Your Email is not verify Click Here For '. $link1 ."\n";
        } 
        return $errors;
        die;
    }

    function userRegMail($uid = null, $email = null) 
    {
        $id = convert_uudecode(base64_decode($uid));
        $user= TableRegistry::get('Users');
        $user_info = $user->find()
        ->where(['id'=>$id])
        ->hydrate(false)
        ->first();
        $template = TableRegistry::get('EmailTemplates');
        $queryInfo = $template
        ->find()
        ->where(array(
                'id' =>'6'
            )
        ); 
        $link = '<a href="'.HTTP_ROOT.'home/verify_email/'.$uid.'/'.$email.'">Click Here</a>';               
        $templateInfo = $queryInfo->first();
        $emailContent = $templateInfo['html_content'];
        $emailContent = str_replace('{username}',$user_info['user_name'], $emailContent);
        $emailContent = str_replace('{link}',$link, $emailContent);
        $email = new Email();
        $email->viewVars(['emailContent' => $emailContent]);
        $email->template('common_template','default')
            ->emailFormat('html')
            ->to($user_info['email'])
            ->from($templateInfo['from_email'],$templateInfo['from_name'])
            ->subject($templateInfo['subject'])
            ->send();
            // prx($emailContent);
       $this->Flash->info('we have sent you an email. Please click on the verification link.');
       $this->redirect(HTTP_ROOT.'home/');
    }

    function validateUserForgetPasswordAjax()
    {
        if ($this->request->is('ajax')) {
            $errors_msg = null;
            $data = $this->request->data;
            $errors = $this->validateUserForgetPassword($data);
            foreach($data['Users'] as $key => $value)
                {
                if (array_key_exists($key, $errors))
                    {
                    foreach($errors[$key] as $k => $v)
                        {
                        $errors_msg.= "error|$key|$v";
                        }
                    }
                  else
                    {
                    $errors_msg.= "ok|$key\n";
                    }
                }
            echo $errors_msg;
            die;
        }
    }

    function validateUserForgetPassword($data)
    {
        $errors = array();
        $this->loadModel('Users');
        $queryInfo = $this->Users->find()
                ->where(array(
                    'email' =>$data['Users']['email'],
                    )
                )
                ->first();
        if (trim($data['Users']['email']) == "")
        {
            $errors['email'][] = __('This field is required.') . "\n";
        }
         
        else if($data['Users']['email'] != "") {

            if($this->isValidEmail(trim($data['Users']['email'])) == 'false') {
                $errors['email'][] = __('Please enter valid email.')."\n";  
            } elseif(empty($queryInfo)) {
                $errors['email'][] = "Please Enter Valid Email"."\n";
            }  
        } 
        return $errors;
        die;
    }

    public function validateUserResetPasswordAjax()
    {
                
        if($this->request->is('ajax')) {
            $errors_msg = null;
            $data = $this->request->data;
            $errors=$this->validateUserResetPassword($data);

            if( !empty($data)) {
                foreach($data['Users'] as $key => $value) {
                    if(array_key_exists($key, $errors)) {

                        foreach($errors[$key] as $k => $v) {
                            $errors_msg .= "error|$key|$v";
                        }   
                    } else {
                        $errors_msg .= "ok|$key\n";
                    }
                }
            }

            echo $errors_msg;
            die;
        }
    }
       
    public function validateUserResetPassword($data)
    {

        if(trim($data['Users']['password']) == "") {
            $errors['password'][] = __('This field is required.')."\n";
        }

        if(trim($data['Users']['confirm']) == "") {
            $errors['confirm'][] = __('This field is required.')."\n";
        }

        if(!empty($data['Users']['password'])) {
                if(trim($data['Users']['password']) !== trim($data['Users']['confirm'])) {
                $errors['password'][] = __('Password does Not matched.')."\n";
            }   
        }

        return $errors;
        die;
    }

     public function validateUserEditProfileAjax()
    {    
        if($this->request->is('ajax')) {
            $errors_msg = null;
            $data = $this->request->data;
            $errors=$this->validateUserEditProfile($data);

            if( !empty($data)) {
                foreach($data['Users'] as $key => $value) {
                    if(array_key_exists($key, $errors)) {

                        foreach($errors[$key] as $k => $v) {
                            $errors_msg .= "error|$key|$v";
                        }   
                    } else {
                        $errors_msg .= "ok|$key\n";
                    }
                }
            }

            echo $errors_msg;
            die;
        }
    }
       
    public function validateUserEditProfile($data)
    {
        $errors = array();
        $this->loadModel('Users');
        if($data['Users']['section'] == "persnal") {
            if(trim($data['Users']['user_name']) == "") {
                $errors['user_name'][] = __('This field is required.')."\n";
            } else if( !preg_match('/^[a-z]/i', $data['Users']['user_name'])) { 
                    $errors['user_name'][] = "Please enter valid name"."\n";
                }

            if(trim($data['Users']['gender'])=="") {
                $errors['gender'][] = __('This field is required')."\n";
            }

            if(trim($data['Users']['socal_status'])=="") {
                $errors['socal_status'][] = __('This field is required')."\n";
            }

            if(trim($data['Users']['search_criteria'])=="") {
                $errors['search_criteria'][] = __('This field is required')."\n";
            }
        }
       
        if($data['Users']['section'] == "contact") { 
            if(trim($data['Users']['phone'])=="") {
                $errors['phone'][] = __('This field is required')."\n";
            }elseif(trim($data['Users']['phone'])!="") {
                if(!(is_numeric($data['Users']['phone']))) {
                    $errors['phone'][] = "Enter numeric value only"."\n";
                }
                if(strlen($data['Users']['phone']) <7 || strlen($data['Users']['phone']) > 14 ){
                    $errors['phone'][] = "Enter valid phone number"."\n";   
                }
            }
             if(!empty($data['Users']['age'])) {
               if(!(is_numeric($data['Users']['age']))) {
                    $errors['age'][] = "Enter numeric value only"."\n";
                } else if (strlen($data['Users']['age']) > 2) {
                    $errors['age'][] = "Please Enter Valid preferred age"."\n";
                }
            }
        }

        if($data['Users']['section'] == "interest") { 
            if(trim($data['Users']['country_id'])=="") {
                $errors['country_id'][] = __('This field is required')."\n";
            }
            if(trim($data['Users']['state_id'])=="") {
                $errors['state_id'][] = __('This field is required')."\n";
            }
            if(trim($data['Users']['city_id'])=="") {
                $errors['city_id'][] = __('This field is required')."\n";
            }
        }
        
        return $errors;
        die;
    }

    public function validateUserChangePasswordAjax()
        {          
            if($this->request->is('ajax')) {
                $errors_msg = null;
                $data = $this->request->data;
                $errors=$this->validateUserChangePassword($data);

                if( !empty($data)) {
                    foreach($data['Users'] as $key => $value) {
                        if(array_key_exists($key, $errors)) {

                            foreach($errors[$key] as $k => $v) {
                                $errors_msg .= "error|$key|$v";
                            }   
                        } else {
                            $errors_msg .= "ok|$key\n";
                        }
                    }
                }

                echo $errors_msg;
                die;
            }
        }

    public function validateUserChangePassword($data)
    {
        $errors = array();
        $Users = TableRegistry::get('Users');
        $userId = $this->request->session()->read('Auth.User.id');
        $queryInfo = $Users
                    ->find()
                    ->where(['id'=>$userId])
                    ->hydrate(false)
                    ->first();

        if(trim($data['Users']['current_pass']) == "") {
            $errors['current_pass'][] = __('This field is required.')."\n";
        } elseif($data['Users']['current_pass'] != $queryInfo['decode_password']) {
            $errors['current_pass'][] = __('Please Enter Valid Current Password .')."\n";
        }

        if(trim($data['Users']['password']) == "") {
            $errors['password'][] = __('This field is required.')."\n";
        }

        if(trim($data['Users']['retype_pass']) == "") {
            $errors['retype_pass'][] = __('This field is required.')."\n";
        } elseif(!empty($data['Users']['retype_pass'])) {
                if(trim($data['Users']['password']) !== trim($data['Users']['retype_pass'])) {
                $errors['retype_pass'][] = __('Password does Not matched.')."\n";
            }   
        }

        return $errors;
        die;
    }

    public function validaterateUserProfileAjax()
    {
        if($this->request->is('ajax')) {
            $errors_msg = null;
            $data = $this->request->data; 
            $errors=$this->validaterateUserProfile($data);
            
            if( !empty($data)) {

                foreach ($data['Reviews'] as $key => $value ) {

                    if(array_key_exists($key, $errors)) {

                        foreach($errors[$key] as $k => $v) {
                            $errors_msg .= "error|$key|$v";
                        }

                    } else {
                        $errors_msg .= "ok|$key\n";
                    }

                }

            }

            echo $errors_msg;
            die;
        }   
    }
    public function validaterateUserProfile($data)
    {
           
        $errors = array();
        if(trim($data['Reviews']['description']) == "") {
            $errors['description'][] = __('This field is required.')."\n";
        }
        
        return $errors;
        die;
    }

    function validateReportUserAjax()
    {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $errors_msg = null;
            $errors = $this->validateReportUser($this->request->data);

            // f ( is_array ( $this->data ) )
                foreach($this->request->data as $key => $value) {
                    
                    if (array_key_exists($key, $errors)) {
                        foreach($errors[$key] as $k => $v) {
                            $errors_msg.= "error|$key|$v";
                        }
                    } else {
                        $errors_msg.= "ok|$key\n";
                    }
                }               
            echo $errors_msg;
            die;
        }
    }

    
    function validateReportUser($data) 
    {
        $errors = array();
        if (trim($data['reason']) == "") {
            $errors['reason'][] = __('This field is required.') . "\n";
        } 
        return $errors;
        die;
    }

    

    public function validatecontactsAjax()
    {
        if($this->request->is('ajax')) {
                $errors_msg = null;
                $data = $this->request->data;
                $errors=$this->validatecontacts($data);
                
                if( !empty($data)) {

                    foreach ($data['Contacts'] as $key => $value ) {

                        if(array_key_exists($key, $errors)) {

                            foreach($errors[$key] as $k => $v) {
                                $errors_msg .= "error|$key|$v";
                            }

                        } else {
                            $errors_msg .= "ok|$key\n";
                        }

                    }

                }

                echo $errors_msg;
                die;
            }   
    }
    public function validatecontacts($data)
    {
           
        $errors = array();
        if(trim($data['Contacts']['user_name']) == "") {
            $errors['user_name'][] = __('This field is required.')."\n";
        }
        if(trim($data['Contacts']['email_id']) == "") {
            $errors['email_id'][] = __('This field is required.')."\n";
        } else if($data['Contacts']['email_id'] != "") {

            if($this->isValidEmail(trim($data['Contacts']['email_id'])) == 'false') {
                $errors['email_id'][] = __('Please enter valid email.')."\n";  
            }
        }
        if (trim($data['Contacts']['phone']) == ""){
           $errors['phone'][] = __('This field is required.')."\n";

        } elseif(trim($data['Contacts']['phone'])!="") {
            if(!(is_numeric($data['Contacts']['phone']))) {
                $errors['phone'][] = "Enter numeric value only"."\n";
            }
            if(strlen($data['Contacts']['phone']) <7 || strlen($data['Contacts']['phone']) > 14 ){
                $errors['phone'][] = "Enter valid phone number"."\n";   
            }
        }
        if (trim($data['Contacts']['message']) == ""){
           $errors['message'][] = __('This field is required.')."\n";

        }
        return $errors;
        die;
    }

}
?>