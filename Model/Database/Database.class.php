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
    use PDO;
    
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
    
    public function run()
    {
        try
        {
            $this -> prepare( $this -> sql );
            $execute = $this -> execute( $this -> param );
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
            $this -> prepare( $this -> sql );
            $this -> execute( $this -> param );
            $fetch = $this -> fetch();
        }
        catch( PDOException $Exception )
        {
            throw new \Exception( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
        }
        
        return $fetch;
    }
}