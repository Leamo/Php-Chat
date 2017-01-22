<?php
namespace App\Controller;

use App\App;
use App\Model\Entity\Message;
use App\Model\EntityManager\MessageManager;

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

	public function refresh() {
		$app = App::getInstance();
		$messageManager = new MessageManager($app->getDb());
		$resonse = [];

		$messages = $messageManager->findAll();
		foreach ($messages as $message) {
			$response[] = $message->getContent();
		}

		echo json_encode($response);
	}
}