<?php

namespace User;
/**
 * Description of User
 *
 * @author Максим
 */
class Account 
{
    public $id;
    public $Role;
    public $User;
    
    private $Post;
    
    public $tpl = NULL;
    
    private $IS_LOGGINED = false;
    
    private static $Instance;
    
    public function __construct( User &$User = NULL )
    {
        $this -> User = $User;
        $this -> Post = &$_GET;
    }

    public function Instance()
    {
        if ( empty( self::$Instance ) )
        {
            self::$Instance = new Account( $this -> User );
        }
        
        return self::$Instance;
    }    
    /**
     * Check()
     * Check weather fo login account
     * @return bool IS_LOGGINED
     */
    public function Check()
    {
        return $this -> IS_LOGGINED;
    }

    public function FakeOpen()
    {
        if ( $this -> Check() )
        {
            $this -> SetTemplate( "User_OpenedAccount" );
        }
        else if ( !array_key_exists('login', $this -> Post) || 
                !array_key_exists('pw', $this -> Post) )
        {
            $this -> SetTemplate( "User_OpenAccount" );
        }
        
        if ( empty( $this -> GetTemplate() ) )
        {
            $this -> SetTemplate( "User_Account" );
            $this -> User -> FakeOpen();
            $this -> IS_LOGGINED = true;
        }
     
        return $this -> Check();
    }
    
    public function GetTemplate()
    {
        return self :: Instance() -> tpl;
    }

    public function SetTemplate( $template )
    {
        return ( self :: Instance() -> tpl = $template );
    }
}