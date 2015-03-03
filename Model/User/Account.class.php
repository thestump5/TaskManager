<?php

namespace User;
use Repositoriy\Repositoriy;
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
    
    public function __construct()
    {
        $this -> Post = &$_GET;
    }

    public function Instance()
    {
        if ( empty( self::$Instance ) )
        {
            self::$Instance = new Account();
        }
        
        return self::$Instance;
    }    
    
    /**
     * Check()
     * Check state account
     * @return bool
     */
    
    public function Check()
    {
        return ( TRUE === $this -> IS_LOGGINED );
    }

    /**
     * Implements command interface
     */
    
    public function Open() //Test edition!
    {
        if ( $this -> Check() )
        {
            $this -> SetTemplate( "User_OpenedAccount" );
        }
//        else if ( !array_key_exists('login', $this -> Post) || 
//                !array_key_exists('pw', $this -> Post) )
//        {
//            $this -> SetTemplate( "User_OpenAccount" );
//        }
        else 
        {
            $this -> SetTemplate( "User_Account" );
            $this -> IS_LOGGINED = true;
        }
        
        if ( !empty( $this -> User ) )
        {
            $this -> User -> Create( $this -> Post );
            var_dump($this);
        }
        
        return $this -> Check();
    }
    
    public function Close() 
    {
        $state1 = Repositoriy :: Instance() -> Close( "AC_ALL");
        $state2 = $this -> User -> Close();
        
        foreach ( $this as $property )
        {
            if ( typeof($property) !== bool ) 
            { 
                unset( $property );
            } 
            else 
            { 
                $property = FALSE;
            }
        }
        
        return ( TRUE === ( $state1 == $state2 ) );
    }
    
    public function Save() 
    {
        ;
    }

    public function Create( $field ) 
    {
        ;
    }
    
    /**
     * Self account part
     */
    
    public function GetClass()
    {
        return __CLASS__ . ":"  . __METHOD__;
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