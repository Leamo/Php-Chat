<?php 

namespace App\Model\EntityManager;

use Core\Database\MysqlDatabase;
use App\Model\Entity\User;

class UserManager {
	private $db;

    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
    }

    public function add(User $user)
  	{
  		$statement = 'INSERT INTO user(name, password) VALUES(?, ?)';
  		$this->db->prepare($statement,[$user->getName(), $user->getPassword()], true);
  	}

  	public function delete($id)
	{
		$statement = 'DELETE FROM user WHERE id = ?';
		$this->db->prepare($statement,[(int) $id], true);
	}

	public function update(User $user)
	{
		$statement = 'UPDATE user SET name = ?, password = ? WHERE id = ?';
		$this->db->prepare($statement,[$user->getName(), $user->getPassword(), $user->getId()], true);
	}

	public function find($id)
	{
		$statement = 'SELECT * FROM user WHERE id = ?';
		$data = $this->db->prepare($statement,[(int) $id], true);

		return new User($data);
	}

	public function findByName($name)
	{
		$statement = 'SELECT * FROM user WHERE name = ?';
		$data = $this->db->prepare($statement,[$name], true);

		if ($data) {
			return new User($data);
		} else {
			return false;
		}
	}

	public function findAll()
	{
		$users = [];

		$statement = 'SELECT * FROM user';
		$list = $this->db->prepare($statement,[] , false);

		foreach ($list as $data) {
			$users[] = new User($data);
		}

		return $users;
	}
}