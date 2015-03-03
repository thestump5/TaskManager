<?php

namespace Repositoriy;

/**
 * Description of TaskRepositoriy
 *
 * @author Максим
 */

class Repositoriy {
    
    public $repositoriy;
    
    protected $Task;
    protected $Project;
    
    public static $Instance;
    
    function __construct() 
    {
        if ( empty( $this -> Post ) )
        {
            $this -> Post = &$_GET;//$_POST!
        }
    }
    
    public static function Instance()  
    {
       if ( empty( self :: $Instance ))
       {
           self :: $Instance = new Repositoriy();
       }
       
       return self :: $Instance;
    }
    
    public function Open( &$obj, &$fileds = [] )
    {
        $obj -> id = 1;
        if ( empty( $fileds ) )
        {
            $fileds = [];
        }
        
        return FALSE;
    }

    public function Close( &$obj )
    {
        //close db connection and post array
        unset( self :: Instance() -> Post );
        
        //Unset obj
        unset( $obj );
        
        return ( TRUE == !empty( $obj ) );
    }
    
    public function Save( &$obj )
    {
        $obj -> id = 1;
        return FALSE;
    }    
    
    public function Create( &$obj )
    {
        if ( !empty( $obj -> User ) )
        {
            $obj -> User -> Create( $this -> Post );
        }
        return FALSE;
    }    
}
