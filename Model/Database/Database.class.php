<?php

namespace Database;
use Database\QueryBuilder,
    Database\PDO;

/**
 * Description of User
 * @author stump
 */
class Database
{
    use PDO
    {
        prepare as pdo_prepare;
        execute as pdo_execute;
    }
    
    public $sql;
    public $param = [];
            
    public function __construct()
    {
        $this -> connect();
    }
    
    public function Build( QueryBuilder $Query )
    {
        $this -> sql = !$Query -> apply()
                        ? ""
                        : $Query -> sql;
        return ( bool )$this -> sql;
    }
    
    public function execute()
    {
        //Может быть try...catch перенести в класс PDO ?
        try
        {
            $this -> pdo_prepare( $this -> sql );
            $execute = $this -> pdo_execute( $this -> param );
        }
        catch( PDOException $Exception )
        {
            throw new \Exception( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
        }
        
        return ( bool )$execute;
    }
    
    public function query()
    {    
        try
        {
            $this -> pdo_prepare( $this -> sql );
            $this -> pdo_execute( $this -> param );
            $fetch = $this -> fetch();
        }
        catch( PDOException $Exception )
        {
            throw new \Exception( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
        }
        
        return $fetch;
    }
    
    public function transaction()
    {
        $transaction = FALSE;
        try
        {
            $transaction = $this -> start_transaction();
        }
        catch( PDOException $Exception )
        {
            throw new \Exception( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
        }    
        
        return $transaction;
    }
    
    public function commit()
    {
        $transaction = FALSE;
        try
        {
            $transaction = $this -> commit_transaction();
        }
        catch( PDOException $Exception )
        {
            throw new \Exception( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
        }    
        return $transaction;
    }
}