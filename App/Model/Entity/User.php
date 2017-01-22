<?php
namespace App\Model\Entity;

use Core\Entity\Entity;

class User extends Entity
{
	private $_id;
	private $_name;
	private $_password;

    public function getId()
    {
        return $this->_id;
    }

    public function setId($id)
    {
        $this->_id = $id;

        return $this;
    }

    public function getName()
    {
        return $this->_name;
    }


    public function setName($name)
    {
        $this->_name = $name;

        return $this;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function setPassword($password)
    {
        $this->_password = $password;

        return $this;
    }
}