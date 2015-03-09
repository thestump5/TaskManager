<?php

trait Singleton 
{
    private static $Instance;
    
    public static function Instance()
    {
        if ( empty(self::$Instance) )
        {
            $class = __CLASS__;
            self::$Instance = new $class();
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
