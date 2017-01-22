<?php
namespace App\Controller;

use App\App;

class DefaultController extends AppController
{
	public function login() {
		$app = App::getInstance();
		$db = $app->getDb();
		$this->render('login');
	}
}