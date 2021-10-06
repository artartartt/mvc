<?php


ini_set('display_errors',1);
error_reporting(E_ALL);

require_once 'conf/config.php';
spl_autoload_register(function ($class_name) {
  var_dump($class_name );
});

require_once 'core/Router.php';

$route = new Router();
$route->run();




?>