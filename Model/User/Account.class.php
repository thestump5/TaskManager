<?php

namespace User;
use User\Role;
use Repositoriy\Repositoriy;
/**
 * Description of User
 *
 * @author Максим
 */
class Account
{
    public $id;
    public $attribute; //not used
    
    public $Role;
    public $User;
    
    public $tpl = NULL;
    
    public $IS_LOGGINED = false;
    
    function __construct() 
    {
        if ( empty( $this -> Role ) )
        {
            $this -> Role = new Role();
        }
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
     * Open()
     * Call to repositoriy for get data who's saved in db early
     * @return bool wheather is open
     */
    
    public function Open() //Test edition!
    {
        if ( $this -> Check() ) return FALSE;
        $this ->SetTemplate( "User_Account" );
        return ( FALSE == Repositoriy :: Instance() -> Open( $this ));
    }

    /**
     * Close()
     * Call to repositoriy for close connection's
     * and posted data.
     * @return bool wheather is data closed
     */
    
    public function Close() 
    {
        if ( !$this -> Check() ) return FALSE;
        $this ->SetTemplate( "User_OpenAccount" );
        return ( FALSE == Repositoriy :: Instance() -> Close( $this ) );
    }
    
    /**
     * Save()
     * Call to repositoriy for save user data
     * @return bool wheather is data saved
     */
    
    public function Save() 
    {
        $this ->SetTemplate( "User_OpenedAccount" );
        return ( FALSE == Repositoriy :: Instance() -> Save( $this ) );
    }

    /**
     * Create()
     * Call to repositoriy for fill data
     * @return bool wheather is account created
     */
    
    public function Create() 
    {
        $this ->SetTemplate( "User_CreateAccount" );
        return ( FALSE == Repositoriy :: Instance() -> Create( $this ) );
    }
    
    /**
     * GetTemplate()
     * return is setting class template
     * @return string
     */
    
    
    public function GetTemplate()
    {
        return $this -> tpl;
    }

    /**
     * SetTemplate()
     * Set the class template
     * @return string template
     */
    
    public function SetTemplate( $template )
    {
        return ( $this -> tpl = $template );
    }
}