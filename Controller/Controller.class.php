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
            $this -> Index();
        }
    }
    
    private function Index() 
    {
        View:: Instance() -> tpl = 'User_OpenAccount';
        View :: Instance() -> Output();
    }
    
    /*
     * User section
     */
    
    private function UserLogin()
    {
        if ( User :: Instance() -> Account() -> Open() )
        {
            $tpl = User :: Instance() -> Account() -> GetTemplate();
        }
        
        View:: Instance() -> tpl = empty($tpl) ? "User_OpenAccount" : $tpl;
        View :: Instance() -> Output();
    }
    
    private function UserLogout()
    {
        if ( User :: Instance() -> Account() -> Close() )
        {
            $tpl = User :: Instance() -> Account() -> GetTemplate();
        }
        
        View:: Instance() -> tpl = empty($tpl) ? "User_OpenAccount" : $tpl;
        View :: Instance() -> Output();
    }
    
    private function UserSelect()
    {
        if ( User :: Instance() -> Account() -> User -> Open() )
        {
            $tpl = User :: Instance() -> Account() -> GetTemplate();
        }

        View:: Instance() -> tpl = empty( $tpl ) ? "None_Empty" : $tpl;
        View :: Instance() -> Output(  );
    }
    
    private function UserAuthentificate()
    {
        ;
    }
    
    /**
     * Project section
     */
    
    private function ProjectOpen()
    {
        ;
    }

    private function ProjectAccept()
    {
        ;
    }
    
    private function ProjectClose()
    {
        ;
    }    

    private function ProjectSelect()
    {
        ;
    }
    
    private function ProjectLeave() //покинуть проект
    {
        ;
    }
    
    /**
     * Error section
     */
    
    private function __404()
    {
        View:: Instance() -> tpl = 'Error_e404';
        View :: Instance() -> Output(  );
    }
}