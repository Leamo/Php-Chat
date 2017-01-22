<?php

namespace Core\Database;

use \PDO;

class MysqlDatabase extends Database
{
	private $db_name;
    private $db_user;
    private $db_pass;
    private $db_host;
    private $pdo;

    public function __construct($db_name, $db_user = 'root', $db_pass = 'root', $db_host = 'localhost')
    {
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
    }

    public function getPDO() {
    	if ($this->pdo === null) {
    		$pdo = new PDO('mysql:dbname='.$this->db_name.';host='.$this->db_host, $this->db_user, $this->db_pass);
    		$pdo->setAttributes(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		$this->pdo = $pdo;
    	}
    	return $this->pdo;
    }
}