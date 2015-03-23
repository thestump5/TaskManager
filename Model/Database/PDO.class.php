<?php

namespace Database;

/**
 * Description of PDO
 * @author stump
 */

//TODO: Exception to check error;

trait PDO 
{
    private $pdo;
    private $statement;

    private $DB_HOST = '127.0.0.1';
    private $DB_NAME = 'mydb';
    private $DB_USER = 'root';
    private $DB_PW = '1111';
    
    public function __get( $name )
    {
        echo $name;
        return $this -> $name;
    }
    
    public function connect()
    {
        $this -> pdo = new \PDO(
                "mysql:host=" . $this -> DB_HOST . " ;dbname=" . $this -> DB_NAME . ";", 
                $this -> DB_USER, 
                $this -> DB_PW
            );
        return ( bool ) $this -> pdo;
    }
    
    public function close()
    {
        $this -> pdo = NULL;
    }
    
    public function prepare( $sql )
    {
        return ( TRUE == ( $this -> statement = $this -> pdo -> prepare( $sql ) ) );
    }
    
    public function execute( $param )
    {
        return ( TRUE == $this -> statement -> execute( $param ) );
    }
    
    public function fetch()
    {
        return $this -> statement -> fetchAll( \PDO::FETCH_CLASS );
    }
    
    public function lastId()
    {
        return $this -> pdo -> lastInsertId();
    }
}