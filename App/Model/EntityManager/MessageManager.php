<?php 

namespace App\Model\EntityManager;

use Core\Database\MysqlDatabase;
use App\Model\Entity\Message;

class MessageManager {
	private $db;

    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
    }

    public function add(Message $message)
  	{
  		$statement = 'INSERT INTO message(content, datetime, user_id) VALUES(?, ?, ?)';
  		$date = (new \DateTime())->format('Y-m-d H:i:s');
  		$this->db->prepare($statement,[$message->getContent(), $date, $message->getUserId()], true);
  	}


	public function find($id)
	{
		$statement = 'SELECT * FROM message WHERE id = ?';
		$data = $this->db->prepare($statement,[(int) $id], true);

		return new Message($data);
	}

	public function findAll()
	{
		$messages = [];

		$statement = 'SELECT * FROM message';
		$list = $this->db->prepare($statement,[] , false);

		foreach ($list as $data) {
			$messages[] = new Message($data);
		}

		return $messages;
	}
}