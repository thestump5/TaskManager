<?php

namespace Database;

/**
 * Description of PDO
 * @author Максим
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
        $this -> pdo = new \PDO("mysql:host=" . DB_HOST . " ;dbname=" . DB_NAME . ";", DB_USER, DB_PW);
        return $this -> pdo;
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
            : $this -> statement -> execute( $param );
    }
    
    public function fetch()
    {
        return empty( $this -> pdo )
            ? "Run without pdo connetcion"
            : $this -> statement -> fetchAll( \PDO::FETCH_CLASS );        
    }
}