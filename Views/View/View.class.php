<?php

namespace View;

/**
 * Description of View
 *
 * @author Максим
 */
class View 
{
    public static $Instance;
    public $tpl;
    public $render = NULL;
    
    function __construct()
    {
        ;
    }
    
    public static function Instance()
    {
        if ( empty( self::$Instance ) )
        {
            self::$Instance = new View();
        }
        
        return self::$Instance;
    }
    
    public function tpl()
    {
        $docroot = $_SERVER['DOCUMENT_ROOT'] . '/../Views/';
        $tpl = str_replace( "\\", "/", $docroot . $this -> tpl);
        $tpl = str_replace( "//", "/", $tpl);
        if ( file_exists($tpl) )
        {
            $this -> render = file_get_contents( $tpl );
        }
        else
        {
            throw new \Exception( "No template to render" );
        }
        
        return true;
    }
    
    public function Output( $state = true )
    {
        if ( empty( $this -> tpl ) )
        {
            throw new \Exception( "No template to render" );
        }
        else
        {
            ob_start();
                
                self :: Instance() -> tpl();
                echo $this -> render;
                
            ob_flush();
        }
        
        return $state;
    }
}
