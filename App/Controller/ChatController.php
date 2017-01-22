<?php
namespace App\Controller;

use App\App;

class ChatController extends AppController
{
	
	public function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION['auth'])) {
			header("Location: /?p=default.login");
			die();
		}
	}

	public function index(){
		$this->render('home');
	}
}