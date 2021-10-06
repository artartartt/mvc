<?php


class Router {
  protected $routes = [];

  public function __construct() {
    $arr = require  'conf/route.php';
    foreach ($arr as $key => $val ){
      $this->add($key,$val);
    }

  }

  public function add($route,$params) {
    $route = '#^'.$route.'$#';
    $this->routes[$route] = $params;
  }
  public function match() {

    $url = trim( $_SERVER['REQUEST_URI'], 'rec/');
    foreach ($this->routes as $route => $params) {
      if ( preg_match($route,$url,$matches) ){
        $this->params = $params;
        return true;
      }
    }
    return false;
  }
  public function run() {
    if ($this->match()){
      $controller = 'controllers/'.ucfirst($this->params['controller'])."Controller.php";

      if(class_exists($controller)){
        echo 'ok';
      }
      else{
        echo "He nayden".$controller;
      }
    }
    else{
      echo "Marshrut ne nayden";
    }
  }


}
