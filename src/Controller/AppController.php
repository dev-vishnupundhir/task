<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Paginator');
        $this->loadComponent('Resize');
        $this->loadComponent('Utility');
        $this->loadComponent('Cookie', ['expiry' => '30 day']);
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    function isValidEmail($email)
    {
        $pattern= "/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\.[.a-zA-Z0-9_-]+)$/";
        $email = trim($email);
        if(preg_match($pattern, $email)) {
            return false;
        } else {
            return true;
        }
    }

    function imgUpload($img_detail = null , $imgwidth = null , $imghight = null , $targetpath = null ,$resizewidth = null , $resizehight = null )
    {
        // prx(get_declared_classes());
        $_FILES = $img_detail;
        if( !empty($_FILES['image']['name'])) {
            $image_name = pathinfo($_FILES['image']['name']);
            $ext = $image_name['extension'];
            if(is_uploaded_file($_FILES['image']['tmp_name'])) {

                list( $width, $height, $source_type ) = getimagesize($_FILES['image']['tmp_name']);
                   
                if ($width >= $imgwidth && $height >= $imghight) {
                    $new_image = rand(4,10000);
                    $target = realpath($targetpath).'/';
                    $tempFile = $_FILES['image']['tmp_name'];
                    if (is_uploaded_file($tempFile)) {
                        $this->Resize->resize($tempFile, $target.$new_image.'.'.$ext, 'aspect_fill', $resizewidth, $resizehight, 0, 0, 0, 0);
                        $image = $new_image.'.'.$ext;
                    }
                    $image = $new_image.'.'.$ext;

                    return $image;
                } else {
                    $this->loadComponent('Flash');
                    $this->Flash->error('Please Upload Higher resolution');     
                    return $this->redirect(  
                        $this->referer()
                    );
                    exit(); 
                }
            }
        }
    }

    ////////// start by punit 13 dec ////////////
    
    function blogimgUpload($img_detail = null , $imgwidth = null , $imghight = null , $targetpath = null ,$resizewidth = null , $resizehight = null )
    {
        // prx(get_declared_classes());
        $_FILES = $img_detail;

        if( !empty($_FILES['image']['name'])) {
            $image_name = pathinfo($_FILES['image']['name']);
            $ext = $image_name['extension'];
            if(is_uploaded_file($_FILES['image']['tmp_name'])) {

                list( $width, $height, $source_type ) = getimagesize($_FILES['image']['tmp_name']);
                   
                if ($width >= $imgwidth && $height >= $imghight) {
                    $new_image = rand(4,10000);
                    $target = realpath($targetpath).'/';
                    $tempFile = $_FILES['image']['tmp_name'];
                    if (is_uploaded_file($tempFile)) {
                        $this->Resize->resize($tempFile, $target.$new_image.'.'.$ext, 'aspect_fill', $resizewidth, $resizehight, 0, 0, 0, 0);
                        $image = $new_image.'.'.$ext;
                    }
                    $targettwo = realpath('../webroot/img/blogImage/thumbnail').'/';
                    $tempFileone = $_FILES['image']['tmp_name'];
                    if (is_uploaded_file($tempFileone)) {
                        $this->Resize->resize($tempFileone, $targettwo.$new_image.'.'.$ext, 'aspect_fill', 250, 250, 0, 0, 0, 0);
                    }
                    $image = $new_image.'.'.$ext;
                    return $image;
                } else {
                    $this->loadComponent('Flash');
                    $this->Flash->error('Please Upload Higher resolution');     
                    return $this->redirect(  
                        $this->referer()
                    );
                    exit(); 
                }
            }
        }
    }

    public function sendAjaxResponse($message = 'No Message', $data = array(), $code = 0) 
    {   
        header('Content-Type: application/json');
        $ajaxResponse = new \stdClass; // creating response object;
        $response = array();
        $response['message'] = $message;  
        $response['data'] = $data;  
        $response['code'] = $code; // for checking errors
        $ajaxResponse->response = $response; 
        return json_encode($ajaxResponse);
    } 

   
    public function sendApiResponse($message = 'No Message', $data = array(), $code = 0) 
    {   
        header('Content-Type: application/json');
        $ajaxResponse = new \stdClass; // creating response object;
        $response = array();
        $response['message'] = $message;  
        $response['data'] = $data;  
        $response['code'] = $code; // for checking errors
        $ajaxResponse->response = $response; 
        return json_encode($ajaxResponse);
    }

    function voiceMsgUpload($imgDetail = null , $targetPath = null)
    {
        $_FILES = $imgDetail;
        if(!empty($_FILES['file']['name'])) {
            $name = $_FILES['file']['name'];
            $name = $this->Utility->randomString() . '-' . $name;
            $sourcePath = $_FILES['file']['tmp_name'];;       // Storing source path of the file in a variable
            $targetPath = $targetPath.'/'.$name; // Target path where file is to be stored
            
            if(is_uploaded_file($_FILES['file']['tmp_name'])) {
                move_uploaded_file($sourcePath, $targetPath);
                return $name;
            }
        }        
    }
}

?>
