<?php
namespace App\Controller;

use App\App;

class DefaultController extends AppController
{
	public function login() {

		if (isset($_SESSION['auth'])) {
			header("Location: /index.php?p=chat.index");
			die();
		}

		$this->render('login');
	}
}