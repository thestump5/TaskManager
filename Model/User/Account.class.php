<?php

namespace User;
use Database\Database;
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
    
    public function __construct( User $User = NULL )
    {
        $this -> User = $User;
        $this -> Post = &$_GET;
    }

    public function Instance()
    {
        if ( empty( self::$Instance ) )
        {
            self::$Instance = new Account(  );
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
        return self :: Instance() -> IS_LOGGINED;
    }

    public function FakeOpen()
    {
        $check = self :: Instance() -> Check();

        if ( $check )
        {
            $this -> SetTemplate( "User_OpenedAccount" );
            return $check;
        }
        else if ( empty( $this -> Post ) )
        {
            //echo "Невозможно открыть аккаунт: форма не передана";
            //throw new \Exception("Невозможно открыть аккаунт: форма не передана");
            $this -> SetTemplate( "User_OpenAccount" );
        }
        else if ( empty( $this -> Post['pw'] ) )
        {
            //echo "Невозможно открыть аккаунт: данные для открытия аккаунта не верны";
            //throw new \Exception("Невозможно открыть аккаунт: данные для открытия аккаунта не верны");
            $this -> SetTemplate( "User_OpenAccount" );
        }
        
        //Database :: Instance() -> CreateSQL( $this, $this -> User, $this -> Post );
        if ( empty( $this -> GetTemplate() ) )
        {
            $this -> SetTemplate( "User_Account" );
        }
        
        return $this -> IS_LOGGINED;// array( $this -> id, $this -> User -> name, $this -> User -> nic );
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