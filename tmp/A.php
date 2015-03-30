<?php

trait Singleton 
{
    private static $Instance;
    
    public static function Instance()
    {
        if ( empty(self::$Instance) )
        {
            self::$Instance = new static::$CLASS_NAME();
        }
        
        return self::$Instance;
    }
    
    function __clone()
    {
        return false;
    }
    
    function __serialize()
    {
        return false;
    }
    
    function __wakeup()
    {
        return false;
    }
    
    function __invoke()
    {
        return false;
    }
    
    function __unset( $name )
    {
        return false;
    }
}

class A 
{
    use Singleton;

    public static $CLASS_NAME = __CLASS__;
    public $teststring;
    
    private function __construct() 
    {
        $this -> teststring = "Test a " . __CLASS__ . " class.";
    }
}

echo A::Instance() -> teststring;
