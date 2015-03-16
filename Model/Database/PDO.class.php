<?php

namespace Database;

/**
 * Description of PDO
 * @author stump
 */

require_once 'config.inc.php';

class PDO 
{
    public $pdo;
    public $statement;
    
    function __construct() 
    {
        $this -> connect();
    }
    
    public function connect()
    {
        $this -> pdo = new \PDO(
                "mysql:host=" . DB_HOST . " ;dbname=" . DB_NAME . ";", 
                DB_USER, 
                DB_PW
            );
        return $this -> pdo;
    }
    
    public function error()
    {
        if ( $this -> pdo -> errorCode() != '00000' )
        {
            throw new \Exception( implode( " ", $this -> pdo -> errorInfo() ) );
        }
        
        return TRUE;
    }

    public function prepare( $sql )
    {
        return empty( $this -> pdo )
            ? "Run without pdo connetcion"
            : ( $this -> statement = $this -> pdo -> prepare( $sql ) );
    }
    
    public function execute( $param )
    {
        return empty( $this -> statement )
            ? "Run without pdo connetcion"
            : empty( $param )
                ? $this -> statement -> execute()
                : $this -> statement -> execute( $param );
    }
    
    public function fetch()
    {
        return empty( $this -> statement )
            ? "Run without pdo connetcion"
            : $this -> statement -> fetchAll( \PDO::FETCH_CLASS );        
    }
}