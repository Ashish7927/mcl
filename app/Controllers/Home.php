<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;

class Home extends BaseController
{
	private $session = null;
	public function __construct()
	{

		$db = db_connect();
		$this->db = db_connect();

		$this->UserModel = new UserModel($db);
		$this->session = session();
		helper(['form', 'url', 'validation']);
	}

   
}

