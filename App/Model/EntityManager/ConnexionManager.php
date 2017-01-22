<?php 

namespace App\Model\EntityManager;

use Core\Database\MysqlDatabase;
use App\Model\Entity\Connexion;

class ConnexionManager {

	private $db;

    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
    }

    public function add(Connexion $connexion)
  	{
  		$statement = 'INSERT INTO connexion(user_id, datetime) VALUES(?, ?)';
  		$date = (new \DateTime())->format('Y-m-d H:i:s');
  		$this->db->prepare($statement,[$connexion->getUserid(), $date], true);
  	}

  	public function update(Connexion $connexion)
  	{
		$statement = 'UPDATE connexion SET datetime = ? WHERE user_id = ?';
		$date = (new \DateTime())->format('Y-m-d H:i:s');
		$this->db->prepare($statement,[$date, $connexion->getUserid()], true);
	}

	public function findByUserId($userId)
	{
		$statement = 'SELECT * FROM connexion WHERE user_id = ?';
		$data = $this->db->prepare($statement,[$userId], true);

		if ($data) {
			return new Connexion($data);
		} else {
			return false;
		}
	}

  	public function findAll()
	{
		$connexions = [];

		$statement = 'SELECT * FROM connexion';
		$list = $this->db->prepare($statement,[] , false);

		foreach ($list as $data) {
			$connexions[] = new Connexion($data);
		}

		return $connexions;
	}

	public function remove($id)
	{
		$statement = 'DELETE FROM connexion WHERE id = ?';
		$this->db->prepare($statement,[(int) $id], true);
	}
}