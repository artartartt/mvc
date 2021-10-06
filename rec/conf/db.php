<?php

/**
 ** class config db
 */
class DB {

  const USER = 'root';
  const PASS = '';
  const HOSR = 'localhost';
  const DB = 'test';

  public static function connToDB(){
    $user = self::USER;
    $pass = self::PASS;
    $host = self::HOSR;
    $db   = self::DB;
    $conn = new PDO("mysql:dbname=$db;host=$host",$user,$pass);
    return $conn;
  }

}



?>
