<?php

namespace Database;
/**
 * Description of User
 *
 * @author Максим
 */

require_once 'config.inc.php';

class Database
{
    public $sql;
    public $c;
            
    public static $Instance;

    public function __construct()
    {
        $this -> c = new \mysqli(DB_HOST, DB_USER, DB_PW, DB_NAME);
    }
    
    public function Instance()
    {
        if ( empty( self::$Instance ) )
        {
            self::$Instance = new Database();
        }
        
        return self::$Instance;
    }
    
    public function CreateSQL( &$Object, &$Object, &$Object )
    {
    }
}
