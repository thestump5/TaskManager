<?php

namespace Database;
use Database\QueryBuilder;

/**
 * Description of User
 * @author stump
 */
class Database
{
    public $pdo;
    
    public $sql = NULL;
    public $param = [];
            
    private $Query;    
    
    public function __construct()
    {
        $this -> pdo = new PDO();
    }
    
    public function Build()
    {
        $this -> Query = new QueryBuilder();
        return $this -> Query;
    }
    
    public function apply( QueryBuilder $Query )
    {
        $this -> sql = empty( $Query -> apply() ) 
                        ? ""
                        : $Query -> sql;
        return $this -> sql;
    }
    
    public function execute()
    {
        $this -> pdo -> prepare( $this -> sql );
        $execute = $this -> pdo -> execute( $this -> param );
        $this -> pdo -> error();
        return $execute;
    }
    
    public function query()
    {    
        $this -> pdo -> prepare( $this -> sql );
        $this -> pdo -> execute( $this -> param );
        $this -> pdo -> error();
        $fetch = $this -> pdo -> fetch();
        return $fetch;
    }
}