<?php

namespace App\Controller;

class DefaultController extends AppController
{
	public function login() {
		$this->render('login');
	}
}