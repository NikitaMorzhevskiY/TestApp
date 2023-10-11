<?php

namespace myfrm;

use PDO;
use PDOException;
use PDOStatement;
class Db
{

    private $connnection;
    private PDOStatement $stmt;
    private static $instance =  null;

    private function __construct()
    {

    }
    private function __clone()
    {

    }
    public function __wakeup()
    {

    }


    public static function getInstance()
    {
        if(self::$instance===null){
            self::$instance= new self();
        }
        return self::$instance;

    }

    public function getConnection(array $db_config)
    {
        if($this->connetction instanceof PDO){
            return $this;
        } 
        $dsn="mysql:host={$db_config['host']};dbname={$db_config['dbname']};charset={$db_config['charset']}";
        try {
            $this->connnection = new PDO($dsn, $db_config['username'],$db_config['password'],$db_config['options']);
            return $this;

        } catch (PDOException $e) {
            abort(500);
        }


        
    }


    public function query($query, $params=[])
    {
        try {
            $this->stmt = $this->connnection->prepare($query);
            $this->stmt->execute($params);  //code...
        } catch (PDOException $e) {
            return false;//throw $th;
        }

        
        return $this;

    }

    public function  findAll() 
    {
       return $this->stmt->fetchAll();

    }


    public function  find() 
    {
       return $this->stmt->fetch();

    }
    public function  findOrFail() 
    {
        $res = $this->find();

        if(!$res){
            abort();

        } 
        return $res;
      

    }
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

}