<?php

namespace Controller;
use View\View;
/**
 * Description of Controller
 *
 * @author Максим
 */
class Controller 
{
    public $request = array();
    
    function __construct( &$request ) 
    {
        $this -> request = (empty($request)) ? array() : $request;
        if ( array_key_exists('action', $this -> request ) &&
                is_callable( array($this, ucfirst( $this -> request['action'] ) ) ) )
        {
            $this -> {$this -> request['action']}(  );
        }
        else if ( array_key_exists('action', $this -> request ) && 
                !is_callable( array($this, ucfirst( $this -> request['action'] ) ) ) )
        {
            $this -> __404();
        }
        else if ( is_callable( array($this, 'Index' ) ) )
        {
            $this -> Index(  );
        }
    }
    
    private function Index(  ) 
    {
        View :: Instance() -> Output(  );
    }
    
    private function Login(  )
    {
        View :: Instance() -> Output(  );
    }
    
    private function __404()
    {
        View:: Instance() -> tpl = '/Error/e404.tpl.php';
        View :: Instance() -> Output(  );
    }
}