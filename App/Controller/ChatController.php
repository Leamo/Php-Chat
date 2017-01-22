<?php
namespace App\Controller;

use App\App;
use App\Model\Entity\Message;
use App\Model\Entity\Connexion;
use App\Model\EntityManager\MessageManager;
use App\Model\EntityManager\UserManager;
use App\Model\EntityManager\ConnexionManager;

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
		if(!empty($_POST)) {
			$app = App::getInstance();
			$messageManager = new MessageManager($app->getDb());

			$message = new Message([
				"content" => $_POST['content'],
				"userId" => $_SESSION['auth']
			]);

			$messageManager->add($message);


		}
		$this->render('home');
	}

	public function refresh() 
	{
		$app = App::getInstance();
		$messageManager = new MessageManager($app->getDb());
		$userManager = new UserManager($app->getDb());
		$resonse = [];

		$messages = $messageManager->findAll();
		foreach ($messages as $message) {
			$user = $userManager->find($message->getUserid());
			$response[$message->getId()]['content'] = $message->getContent();
			$response[$message->getId()]['user'] = $user->getName();
			$response[$message->getId()]['datetime'] = $message->getDatetime();
		}

		echo json_encode($response);
	}

	public function checkConnection()
	{
		$app = App::getInstance();
		$connexionManager = new ConnexionManager($app->getDb());
		$userManager = new UserManager($app->getDb());
		$connexions = $connexionManager->findAll();
		$connectedUsers = [];
		$new = true;

		foreach ($connexions as $connexion) {

			if ($connexion->getUserid() == $_SESSION['auth']) {
				$connexionManager->update($connexion);
				$new = false;			
			}

			$now = new \DateTime();
			$lastupdate = new \DateTime($connexion->getDatetime());
			$interval = $lastupdate->diff($now);

			if ($interval->format('%y') > 0
				|| $interval->format('%m') > 0
				|| $interval->format('%d') > 0
				|| $interval->format('%h') > 0
				|| $interval->format('%i') > 5 
			) {
				$connexionManager->remove($connexion->getId());
			} else {
				$connectedUsers[] = $userManager->find($connexion->getUserid())->getName();
			}
		}

		if($new) {
			$newConnexion = new Connexion([
				"userId" => $_SESSION['auth']
			]);
			$connexionManager->add($newConnexion);
			$connectedUsers[] = $userManager->find($newConnexion->getUserid())->getName();
		}

		echo json_encode($connectedUsers);
	}

	public function logout()
	{
		$app = App::getInstance();
		$connexionManager = new ConnexionManager($app->getDb());
		$connexion = $connexionManager->findByUserId($_SESSION['auth']);
		$connexionManager->remove($connexion->getId());
		unset($_SESSION['auth']);
		header("Location: /?p=default.login");
	}
}