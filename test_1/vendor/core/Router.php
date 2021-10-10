<?php
/**
 * linki het asxatanqner
 */
class Router
{
   /*
   ** ira mejin pahelu enq controller u array
   **zuyg@ vor@ kgtni mer matchRouter funcian
   */
   protected static $route = [];

   /*
   ** ira mejin pahelu mer posts/add ,posts ev ayln inchqan url unenq
   */
   protected static $routes = [];

   /*
   ** stecumenq mez anhrajes url,controller,action
   */
   public static function add($regexp,$route = []) {
      self::$routes[$regexp] = $route;
   }
// veradardnuma mihat array vor@ cuyca talis sax tvyalner@
// ani hat add functia unenq sarqac
   public function getRouters (){
      return self::$routes;
   }
// veradardnuma controllern u action@ vori het hamapatasxanela
   public function getRouter (){
      return self::$route;
   }
// stuguma ardyoq ka useri koxmic tvac posti meji tvyalner@
// ete gtnuma route-i mej lcnuma

   protected static function matchRoute($url){
      foreach(self::$routes as $pattern => $route){
         // meji i-in vor mecatar_poqratar tarberutyun chta
         // $matches ira mej pahuma mihat lrivurl u controller,action
         if(preg_match("#$pattern#i", $url ,$matches)){
            //stex sax elementeri vrov fruma vercnuma nranq voronq stringen
            // u lcnuma route arrayi mej
            foreach($matches as $key => $value){
               if(is_string($key)){
                  $route[$key] = $value;
               }
            }
            if( !isset($route['action']) ){
               $route['action'] = 'index';
            }
            self::$route = $route;
            debug($route);
            return true;
         }
      }
      return false;
   }


   public static function dispatch($url){
      if(self::matchRoute($url)){
         //ay sra hamarel index.phpum grelenq <> u matchroutum string man galis
         $controller = self::upperCamelCase(self::$route['controller']);
         //stugum enq ka ardyoq aydpisi class te che
         if(class_exists($controller)){
            //$controller-i object enq sarqum
            $cObj = new $controller;
            $action = self::lowerCamelCase(self::$route['action'])."Action";
            //cObj-i mej ka action object(class) te che
            if(method_exists($cObj,$action)){
               $cObj->$action();
            }
            else{
               echo " Metod <b> $controller -- $action </b> ne naydeno";
            }
         }
         else {
            echo "controller <b>$controller </b> ne nayden";
         }
      }
      else{
         http_response_code(404);
         require 'public/error_404.html';

      }
   }
// orinak posts-new sarquma PostsNew
   protected static function upperCamelCase($name){
      $name = str_replace("-"," ",$name);
      $name = ucwords($name);
      $name = str_replace(" ","",$name);
      return $name;
   }

   // orinak posts-new sarquma postsNew
   protected static function lowerCamelCase($name){
      return lcfirst(self::upperCamelCase($name));
   }

}



 ?>
