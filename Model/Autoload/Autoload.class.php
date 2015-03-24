<?php

/* 
 * Autoload classes use spl functions
 * class SPL_Autoload
 */

namespace Autoload;

class Autoload
{
    private $doc_root;
    
    function __construct()
    {
        $this -> doc_root = realpath( dirname( __DIR__ ) . "/../www/" );
        
        $this -> load();
        $this -> register();
    }
    
    protected function load()
    {
        $this -> autoload_namespace();
    }
    
    private function autoload_namespace()
    {
        spl_autoload_extensions(".php");
    }
    
    protected function register()
    {
        spl_autoload_register();
        spl_autoload_register(array($this, 'autoload_classes_controller'));
        spl_autoload_register(array($this, 'autoload_classes_model'));
        spl_autoload_register(array($this, 'autoload_classes_view'));
        spl_autoload_register(array($this, 'autoload_classes_test'));
        spl_autoload_register(array($this, 'autoload_interfaces'));
    }
    
    private function autoload_classes_controller( $class )
    {
        $path = $this -> doc_root . '/../' . $class . '.class.php';

        $path = str_replace("\\", "/", $path);
        
        if (is_file($path))
        {
            require_once $path;
        }
    }

    private function autoload_classes_model( $class )
    {
        $path = $this -> doc_root . '/../Model/' . $class . '.class.php';
        
        $path = str_replace("\\", "/", $path);
        
        if (is_file($path))
        {
            require_once $path;
        }
    }    

    private function autoload_classes_view( $class )
    {
        $path = $this -> doc_root . '/../Views/' . $class . '.class.php';

        $path = str_replace("\\", "/", $path);
        
        if (is_file($path))
        {
            require_once $path;
        }
    }    
    
    private function autoload_classes_test( $class )
    {
        $path = $this -> doc_root . '/../test/' . $class . '.class.php';

        $path = str_replace("\\", "/", $path);
        
        if (is_file($path))
        {
            require_once $path;
        }
    }

    private function autoload_interfaces( $class )
    {
        $path = $this -> doc_root . '/../Helpers/Interface/' . $class . '.interface.php';

        $path = str_replace("\\", "/", $path);

        if (is_file($path))
        {
            require_once $path;
        }
    }
}