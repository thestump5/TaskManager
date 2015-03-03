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
        $User = User :: Instance() -> Account();
        if ( $User -> Open() )
        {
            $tpl = $User -> GetTemplate();
        }
        View:: Instance() -> tpl = empty($tpl) ? "User_OpenAccount" : $tpl;
        View :: Instance() -> Output();
    }
    
    private function UserLogout()
    {
        $User = User :: Instance() -> Account();
        if ( $User -> Close() )
        {
            $tpl = $User -> GetTemplate();
        }
        
        View:: Instance() -> tpl = empty($tpl) ? "None_Empty" : $tpl;
        View :: Instance() -> Output();
    }
    
    private function UserCreate()
    {
        $User = User :: Instance() -> Account();
        if ( $User -> Create() ) 
        {
            $tpl = $User -> GetTemplate();
        }

        View:: Instance() -> tpl = empty( $tpl ) ? "None_Empty" : $tpl;
        View :: Instance() -> Output();
    }    
    
    private function UserSelect()
    {
        if ( ($User = ( User :: Instance() -> Account( ( new User() ) -> Account() ) ) ) )
        {
            $User -> Open();
            $tpl = $User -> GetTemplate();
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