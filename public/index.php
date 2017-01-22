<?php
define('ROOT', dirname(__DIR__));
define("APPPATH", ROOT . '/App');

require APPPATH . '/App.php';

App\App::load();

// router en fonction les paramètres de l'url
if(isset($_GET['url'])){
    $page = $_GET['url'];
}else{
    $page = 'default/login';
}

$page = explode('/', $page);

$controller = '\App\Controller\\' . ucfirst($page[0]) . 'Controller';
$action = $page[1];

$controller = new $controller();
$controller->$action();
?>