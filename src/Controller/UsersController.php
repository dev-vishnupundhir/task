<?php
namespace App\Controller;

use App\Controller\AppController;

class UsersController extends AppController
{	 
	public function login()
    {
		$this->redirect('/admin/users/login');
    }
}

