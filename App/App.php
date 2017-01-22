<?php
namespace App;

use Core\Config;
use Core\Database\MysqlDatabase;

/*
 * Class App (Singleton) permettant de charger les autoloaders et une instance de la base de données
 */
class App 
{
	private static $_instance;
	private $db_instance;

	public static function getInstance(){
		if(is_null(self::$_instance)){
            self::$_instance = new App();
        }
        return self::$_instance;
	}

	public static function load()
    {
        if(!isset($_SESSION)) {
		    session_start();
		}
		// chargement des autoloaders
        require APPPATH .'/Autoloader.php';
        Autoloader::register();
        require ROOT . '/Core/Autoloader.php';
        \Core\Autoloader::register();
    }

    public function getDb()
    {
    	// récupération des paramètres de connexion
        $config = Config::getInstance(ROOT . '/config/config.php');

        // instanciation de la BDD si elle n'existe pas
        if(is_null($this->db_instance)) {
            $this->db_instance = new MysqlDatabase($config->get('db_name'), $config->get('db_user'), $config->get('db_pass'), $config->get('db_host'));
        }
        return $this->db_instance;
    }
}