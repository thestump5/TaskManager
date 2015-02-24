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
    
    public static function Instance()  
    {
       if ( empty( self :: $Instance ))
       {
           self :: $Instance = new Repositoriy();
       }
       
       return self :: $Instance;
    }
    
    public function Open( &$obj)
    {
        $obj -> id = (int)rand(0, 1000);
        return FALSE;
    }
    
    public function Save( &$obj )
    {
        $obj -> id = (int)rand(0, 1000);
        return FALSE;
    }
}
