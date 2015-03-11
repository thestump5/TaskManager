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
            
    public function __construct()
    {
        $this -> pdo = new PDO();
    }
    
    public function Build()
    {
        $Query = new QueryBuilder();
        $Query -> sql = "SELECT email, hash FROM auth";
        $this -> applySQL( $Query );
        return $this -> sql;
    }
    
    private function applySQL( QueryBuilder $Query )
    {
        $this -> sql = $Query -> sql;
        return $this -> sql;
    }
    
    public function execute()
    {
        if ( $this -> sql === NULL )
        {
            return "Exception: sql is empty";
        } 
        
        $this -> pdo -> prepare( $this -> sql );
        return $this -> pdo -> execute( $this -> param );
    }
    
    public function query()
    {
        if ( $this -> sql === NULL )
        {
            return "Exception: sql is empty";
        } 
                
        $this -> execute();
        return $this -> pdo -> fetch();
    }
}