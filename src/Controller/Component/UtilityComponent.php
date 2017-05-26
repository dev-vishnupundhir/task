<?php
namespace App\Controller\Component;

use Cake\Controller\Component;

  // use Cake\Controller\Component\ResizeComponent;
// include_once 'ResizeComponent.php';
// $obj1 = new ResizeComponent;

class UtilityComponent extends Component {
	
	private $skey     = "riskleavemealone"; //don't change this 

	private  function safe_b64encode($string) {
	
		$data = base64_encode($string);
		$data = str_replace(array('+','/','='),array('-','_',''),$data);
		return $data;
	}
 
	private function safe_b64decode($string) {
		$data = str_replace(array('-','_'),array('+','/'),$string);
		$mod4 = strlen($data) % 4;
		if ($mod4) {
			$data .= substr('====', $mod4);
		}
		return base64_decode($data);
	}
	
	public  function encode($value){
		
		if(!$value){return false;}
		$text = $value;
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->skey, $text, MCRYPT_MODE_ECB, $iv);
		return trim($this->safe_b64encode($crypttext));
	}
	
	public function decode($value){
	
		if(!$value){return false;}
		$crypttext = $this->safe_b64decode($value);
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->skey, $crypttext, MCRYPT_MODE_ECB, $iv);
		return trim($decrypttext);
	}
	
	
	public function timeAgo($time_ago) {
		$cur_time 	= time();
		$time_elapsed 	= $cur_time - $time_ago;
		$seconds 	= $time_elapsed ;
		$minutes 	= round($time_elapsed / 60 );
		$hours 		= round($time_elapsed / 3600);
		$days 		= round($time_elapsed / 86400 );
		$weeks 		= round($time_elapsed / 604800);
		$months 	= round($time_elapsed / 2600640 );
		$years 		= round($time_elapsed / 31207680 );
		// Seconds
		if($seconds <= 60){
			echo "$seconds seconds ago";
		}
		//Minutes
		else if($minutes <=60){
			if($minutes==1){
				echo "one minute ago";
			}
			else{
				echo "$minutes minutes ago";
			}
		}
		//Hours
		else if($hours <=24){
			if($hours==1){
				echo "an hour ago";
			}else{
				echo "$hours hours ago";
			}
		}
		//Days
		else if($days <= 7){
			if($days==1){
				echo "yesterday";
			}else{
				echo "$days days ago";
			}
		}
		//Weeks
		else if($weeks <= 4.3){
			if($weeks==1){
				echo "a week ago";
			}else{
				echo "$weeks weeks ago";
			}
		}
		//Months
		else if($months <=12){
			if($months==1){
				echo "a month ago";
			}else{
				echo "$months months ago";
			}
		}
		//Years
		else{
			if($years==1){
				echo "one year ago";
			}else{
				echo "$years years ago";
			}
		}
	}
	
	
	public function randomString($length = 6) {
		$str = "";
		$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}

	function sanitizeFilename($f) {
			// a combination of various methods
			// we don't want to convert html entities, or do any url encoding
			// we want to retain the "essence" of the original file name, if possible
			// char replace table found at:
			// http://www.php.net/manual/en/function.strtr.php#98669
			$replace_chars = array(
				 'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
				 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
				 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
				 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
				 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
				 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
				 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f'
			);
			$f = strtr($f, $replace_chars);
			// convert & to "and", @ to "at", and # to "number"
			$f = preg_replace(array('/[\&]/', '/[\@]/', '/[\#]/'), array('-and-', '-at-', '-number-'), $f);
			$f = preg_replace('/[^(\x20-\x7F)]*/','', $f); // removes any special chars we missed
			$f = str_replace(' ', '-', $f); // convert space to hyphen 
			$f = str_replace('\'', '', $f); // removes apostrophes
			$f = preg_replace('/[^\w\-\.]+/', '', $f); // remove non-word chars (leaving hyphens and periods)
			$f = preg_replace('/[\-]+/', '-', $f); // converts groups of hyphens into one
			return strtolower($f);
		}
	// function img_upload($img_detail = null , $imgwidth = null , $imghight = null , $targetpath = null ,$resizewidth = null , $resizehight = null )
	// {
	// 	// prx(get_declared_classes());
	// 	$_FILES = $img_detail;

	// 	if( !empty($_FILES['image']['name'])) {
 //            $image_name = pathinfo($_FILES['image']['name']);
 //            $ext = $image_name['extension'];
 //            if(($ext != 'jpg') && ($ext != 'png') && ($ext != 'jpeg') && ($ext != 'gif')) {
 //                $this->loadComponent('Flash');
 //                $this->Flash->error('Please Upload JPG,PNG,GIF Format Image');

 //                return $this->redirect(  
 //                        $this->referer()
 //                    );
 //                    exit();

 //            } else if(is_uploaded_file($_FILES['image']['tmp_name'])) {

 //                list( $width, $height, $source_type ) = getimagesize($_FILES['image']['tmp_name']);
                   
 //                if ($width >= $imgwidth && $height >= $imghight) {
 //                    $new_image = rand(4,10000);
 //                    $target = realpath($targetpath).'/';
 //                    $tempFile = $_FILES['image']['tmp_name'];
 //                   // prx($resizehight);
 //                    if (is_uploaded_file($tempFile)) {
 //                    	// prx('hello');
 //                    	// $obj1 = new ResizeComponent;
 //                    	// prx($obj1);
 //                        $this->Resize->resize($tempFile, $target.$new_image.'.'.$ext, 'aspect_fill', $resizewidth, $resizehight, 0, 0, 0, 0);
 //                        $image = $new_image.'.'.$ext;

 //                    	return $image;
 //                    }

 //                    $image = $new_image.'.'.$ext;

 //                    return $image;
 //                } else {
 //                    $this->loadComponent('Flash');
 //                    $this->Flash->error('Please Upload Higher resolution');     
 //                    return $this->redirect(  
 //                        $this->referer()
 //                    );
 //                    exit(); 
 //                }
 //            }
 //        }
	// }				
}