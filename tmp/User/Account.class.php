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
    
    private $IS_LOGGINED = false;
    
    public function __construct( User $User )
    {
        $this -> User = $User;
        $this -> Post = &$_POST;
    }

    /**
     * Check() function
     * return weather login Account
     * @return type
     */
    public function Check()
    {
        return $this -> IS_LOGGINED;
    }

    public function Open()
    {
        $check = $this -> Check();
        
        if ( $check )
        {
            return $check;
        }
        else if ( empty( $this -> Post ) )
        {
            echo "Невозможно открыть аккаунт: форма не передана";
            //throw new \Exception("Невозможно открыть аккаунт: форма не передана");
        }
        else if ( empty( $this -> Post['pw'] ) )
        {
            echo "Невозможно открыть аккаунт: данные для открытия аккаунта не верны";
            //throw new \Exception("Невозможно открыть аккаунт: данные для открытия аккаунта не верны");
        }
        
        Database :: Instance() -> CreateSQL( $this, $this -> User, $this -> Post );
        
        return $this -> IS_LOGGINED;// array( $this -> id, $this -> User -> name, $this -> User -> nic );
    }
}