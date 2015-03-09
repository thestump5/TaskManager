<?php

namespace Database;
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
        $this -> sql = "SELECT email, hash FROM auth";
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