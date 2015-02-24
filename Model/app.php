<?php
namespace Main;
use Controller\Controller;
require_once '/../Model/Autoload/Autoload.class.php';
use Autoload\Autoload;

final class App
{
    private static $instance;

    private function __construct()
    {
        new Autoload();
    }
    
    public static function Instance()
    {
        if ( empty( self::$instance ) )
        {
            self::$instance = new App();
        }
        
        return self::$instance;
    }
    
    public static function Init()
    {
        try
        {
            self::Instance();
            new Controller( ( $request = &$_REQUEST ) );
        } 
        catch(\Exception $e)
        {
            self :: Instance() -> Debug( $e );
        }
    }
    
    public function Debug( \Exception $e )
    {
        echo "Exception: <b>" , $e -> getMessage(), "</b> in ", $e -> getFile() 
                , ": ", $e -> getLine(), "<br />";
        echo "<small><italic>";
        echo "<b>Exception stack trace:</b>", "<br />", str_replace("\n", "<br />"
                , $e ->getTraceAsString())
                , "<br />";
        echo "</italic></small>";
    }

    public function Notify( $message )
    {
        if ( is_string( $message ) )
        {
            echo "<br />", $message;
        }
    }
}