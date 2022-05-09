<?php
namespace BlogFram;
 
class PDOFactory
{
  public static function getMysqlConnexion()
  {
    $connectionString = 'mysql:host=127.0.0.1;dbname=test';

    $db = new \PDO($connectionString, 'root', 'root');
    $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
 
    return $db;
  }
}