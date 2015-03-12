<?php

namespace Database;
use Database\QueryBuilder;
/**
 * Description of User
 *
 * @author Максим
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
        //if ( empty( $this -> Query ) )
        {
            $this -> Query = new QueryBuilder();
        }
        
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
        $this -> pdo -> error();
        $execute = $this -> pdo -> execute( $this -> param );
        return $execute;
    }
    
    public function query()
    {    
        $this -> pdo -> prepare( $this -> sql );
        $this -> pdo -> error();
        $this -> pdo -> execute( $this -> param );
        $fetch = $this -> pdo -> fetch();
        return $fetch;
    }
}