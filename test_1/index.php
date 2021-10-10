<?php
// vercnum em url@ ev ktrum fayli anun@ test_1/
$url = rtrim(substr($_SERVER['REQUEST_URI'],8),'/');

define('WWW',$url);
define('ROOT',$url);
define('CORE','vender/core');
define('APP','app');


require 'vendor/libs/debug.php';
require 'vendor/core/Router.php';

spl_autoload_register(function ($class) {
   $file = APP."/controllers/$class.php";
   debug($file);

   if(is_file($file)){
      require $file;
   }
});

//ete pages/ mer mot chka sarqac bayc poiska talis menq iran tanumenq Posts-i vra
// skzbum esa anum u heto nor araja gnum ete skzbic 3-rd add dnem sxal klini
Router::add('^pages/?(?P<action>[a-z-]+)?$',['controller' => 'Posts']);


// Router::add('posts/add',['controller' => 'Posts','action' => 'add']);
// hima ete es dev grenq 100 eji hamar hech harmar chi
// dra hamar kogtagorcenq regulyarni virajenia
// es nerqevi 2 add() poumalchenu pravila
Router::add('^$',['controller' => 'Main','action' => 'index']);

// menq es depqum aynpesenq arel vor vontroller@ kunena ira arjeq@
// actionnel ira   key valui nman
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');


debug(Router::getRouters());
debug(Router:: dispatch($url));



 ?>
