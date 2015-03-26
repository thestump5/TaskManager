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
                $this -> DB_PW,
                array(\PDO::ATTR_PERSISTENT => true)
            );
        return ( bool )$this -> pdo;
    }
    
    public function close()
    {
        $this -> pdo = NULL;
    }
    
    public function transaction()
    {
        try
        {
            return $this -> pdo -> beginTransaction();
        }
        catch( PDOException $Exception )
        {
            throw new \Exception( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
        }
    }
    
    public function commit()
    {
        try
        {
            return $this -> pdo -> commit();
        }
        catch( PDOException $Exception )
        {
            throw new \Exception( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
        }    
    }

    public function rollback()
    {
        try
        {
            return $this -> pdo -> rollBack();
        }
        catch( PDOException $Exception )
        {
            throw new \Exception( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
        }    
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