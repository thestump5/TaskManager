<?php

namespace Database;

/**
 * Description of PDO
 * @author stump
 */

//TODO: Exception to check error;

trait PDO 
{
    protected $pdo;
    protected $statement;
    
    public function connect()
    {
        $this -> pdo = new \PDO(
                "mysql:host='127.0.0.1' ;dbname='mydb';", 
                'root', 
                '1111',
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