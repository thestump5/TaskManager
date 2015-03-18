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
    
    private $Role;
    private $User;
    
    private $tpl = NULL;
    
    private $IS_LOGGINED = false;
    
    function __construct() 
    {
        if ( empty( $this -> Role ) )
        {
            $this -> Role = new Role();
        }
    }    
    
    public function setUser( &$User ) //untested
    {
        $this -> User = $User;
    }
    
//    public function __get( $name )
//    {
//        return $this -> $name;
//    }
    
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
        if ( TRUE == Repositoriy :: Instance() -> Open( $this ) )
        {
            if ( Repositoriy :: Instance() -> Open( $this -> User, [ 'id' => $this -> id ] ) )
            {
                $this -> IS_LOGGINED = TRUE;
                $this -> SetTemplate( "User_Account" );
            }
        }
        else 
        {
            $this -> IS_LOGGINED = FALSE;
        }
        
        var_dump($this);
        
        return $this -> Check();
    }

    /**
     * Close()
     * Call to repositoriy for close connection's
     * and posted data.
     * @return bool wheather is data closed
     */
    
    public function Close() 
    {
        if ( !$this -> Check() ) return TRUE;
        $this -> SetTemplate( "User_OpenAccount" );
        return ( FALSE == Repositoriy :: Instance() -> Close( $this ) );
    }
    
    /**
     * Save()
     * Call to repositoriy for save user data
     * @return bool wheather is data saved
     */
    
    public function Save() 
    {
        $this -> SetTemplate( "User_OpenedAccount" );
        return ( FALSE == Repositoriy :: Instance() -> Save( $this ) );
    }

    /**
     * Create()
     * Call to repositoriy for fill data
     * @return bool wheather is account created
     */
    
    public function Create() 
    {
        $this -> SetTemplate( "User_CreateAccount" );
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