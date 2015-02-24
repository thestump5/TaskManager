<?php

namespace Controller;
use View\View;
use User\User;
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
        View:: Instance() -> tpl = 'User_FormLogin';
        View :: Instance() -> Output(  );
    }
    
    private function Login(  )
    {
        $tpl = "User_OpenAccount";
        if ( array_key_exists('login', $this -> request) &&
                array_key_exists('pw', $this -> request))
        {
            $User = User :: Instance();
            $User -> FakeOpen( $this -> request['login'] );
            $User -> Account() -> FakeOpen(  );
            $tpl = $User -> Account() -> GetTemplate();
        }
        
        View:: Instance() -> tpl = $tpl;
        View :: Instance() -> Output(  );
    }
    
    private function __404()
    {
        View:: Instance() -> tpl = 'Error_e404';
        View :: Instance() -> Output(  );
    }
}