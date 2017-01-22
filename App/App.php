<?php
namespace App;

/*
 * Class App (Singleton) permettant de charger les autoloaders et une instance de la base de données
 */
class App 
{
	private static $_instance;

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
}