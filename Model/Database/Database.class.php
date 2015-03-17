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
        $this -> pdo_prepare( $this -> sql );
        $execute = $this -> pdo_execute( $this -> param );
        return ( bool )$execute;
    }
    
    public function query()
    {    
        
        $this -> pdo_prepare( $this -> sql );
        $this -> pdo_execute( $this -> param );
        $fetch = $this -> fetch();
        return $fetch;
    }
}