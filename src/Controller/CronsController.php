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

	class CronsController extends AppController
	{
		function getOfflineUsers()
		{
			$this->loadModel('Users');
			$currentTime = date('Y-m-d H:i:s',strtotime("-5 min"));
			$userInfo = $this->Users->find()
				->where(['login_status'=>'1','login_update_time <'=>$currentTime])
				->select(['id','user_name'])
				->hydrate(false)
				->toArray();
			$query = $this->Users->query();
			foreach($userInfo as $info) {
				$query->update()
                    ->set(['login_status' => 0,'last_logout'=>$currentTime])
                    ->where(['id' => $info['id']])
                    ->execute();	
			}
		}
	}
?>