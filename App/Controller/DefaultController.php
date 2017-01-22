<?php
namespace App\Controller;

use App\App;
use App\Model\Entity\User;
use App\Model\EntityManager\UserManager;

class DefaultController extends AppController
{
	public function login() {

		if (isset($_SESSION['auth'])) {
			header("Location: /?p=chat.index");
			die();
		}

		$error_login = '';
		$error_subscribe = '';

		if(!empty($_POST)) {

			$app = App::getInstance();
			$userManager = new UserManager($app->getDb());

			if (isset($_POST['login'])) {
				$username = isset($_POST['username']) ? $_POST['username'] : NULL;
				$passwd = isset($_POST['passwd']) ? $_POST['passwd'] : NULL;

				$user = $userManager->findByName($username);
				if ($user) {
					if (password_verify($passwd,$user->getPassword())) {
						$_SESSION['auth'] = $user->getId();
					} else {
						$error_login = 'Mot de passe incorrect';
					}
				} else {
					$error_login = 'Identifiants incorrect';
				}
			}

			if (isset($_POST['subscribe']) 
			&& null !== $_POST['username'] 
			&& null !== $_POST['passwd'] 
			&& null !== $_POST['passwd2']) {
				if ($_POST['passwd'] == $_POST['passwd2']) {
					$user = new User([
						"name" => $_POST['username'],
						"password" => password_hash($_POST['passwd'],PASSWORD_BCRYPT)
					]);
					$userManager->add($user);
					$_SESSION['auth'] = $user->getId();
				} else {
					$error_subscribe = 'Les mots de passe doivent être identiques';
				}
			} else {
				$error_subscribe = 'Veuillez remplir tous les champs';
			}
		}

		$this->render('login', compact('error_login','error_subscribe'));
	}
}