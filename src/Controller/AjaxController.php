<?php
    namespace App\Controller;

    use App\Controller\AppController;

    use Cake\ORM\TableRegistry;

    use Cake\ORM\Query;

    use Cake\Datasource\ConnectionManager;

    ob_start();

    class AjaxController extends AppController 
    {
        public function getState($countryId = null)  
        {
            $this->loadModel('States');
            $stateInfo = $this->States->find()
            ->where(['country_id'=>$countryId])
            ->hydrate(false)
            ->toArray();
            if(empty($stateInfo)) {
                $stateInfo[0] = "No Data";
            } 
            echo json_encode($stateInfo);
            die;
        }

    	public function getCity($stateId = null)  
        {
            $this->loadModel('Cities');
            $cityInfo = $this->Cities->find()
            ->where(['state_id'=>$stateId])
            ->hydrate(false)
            ->toArray();
            if(empty($cityInfo)) {
                $cityInfo[0] = "No Data";
            } 
            echo json_encode($cityInfo);
            die;
        }
    } 
?>