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
    private $render = NULL;
    
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
        self :: Instance() -> prepare_filepath();
        
        if ( file_exists( self :: Instance() -> tpl ) )
        {
            ob_start();
                
                require self :: Instance() -> tpl;
            
            $this -> render =  ob_get_clean();
        }
        else
        {
            throw new \Exception( "No template to send output" );
        }
        
        return true;
    }
    
    public function Output(  )
    {
        if ( empty( self :: Instance() -> tpl ) )
        {
            throw new \Exception( "Template variable empty" );
        }
        else
        {
            self :: Instance() -> tpl();
            echo $this -> render;
        }
        
        return true;
    }
    
    private function prepare_filepath()
    {
        $tpl = dirname(__DIR__) . '/../Views/' . self :: Instance() -> tpl . '.tpl.php';
        
        $tpl = str_replace( "\\", "/", $tpl );
        $tpl = str_replace( "//", "/", $tpl );
        $tpl = str_replace( "_", "/", $tpl );
        
        return ( self :: Instance() -> tpl = $tpl );
    }
}
