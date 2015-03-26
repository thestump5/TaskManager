<?php

namespace User;
use User\Role,
    Repositoriy\Repositoriy;
/**
 * Description of User
 *
 * @author Максим
 */
class Account
{
    public $id;
    public $pw;
    
    private $Role;
    private $Repositoriy;
    
    private $User;
    
    private $tpl = NULL;
    
    private $IS_LOGGINED = false;
    
    function __construct( $Repositoriy = NULL ) 
    {
        $this -> Role = empty( $this -> Role ) ?  new Role() : $this -> Role;
        $this -> Repositoriy = empty( $Repositoriy ) ? Repositoriy::Instance() : $Repositoriy;
        
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
    
    public function Open()
    {
        $Rep = $this -> Repositoriy;
        if ( TRUE == $Rep -> Open( $this ) )
        {
            $Rep -> setFilter( [ 'id' => $this -> id ] );
            if (  TRUE == $Rep -> Open( $this -> User ) )
            {
                
                $this -> IS_LOGGINED = TRUE;
                $this -> SetTemplate( "User_Account" );
            }
        }
        else 
        {
            $this -> IS_LOGGINED = FALSE;
        }
        
        return ( TRUE == $this -> Check() );
    }

    /**
     * Close()
     * Call to repositoriy for close connection's
     * and posted data.
     * @return bool wheather is data closed
     */
    
    public function Close() 
    {
        $this -> SetTemplate( "User_OpenAccount" );
        return ( TRUE == $this -> Repositoriy -> Close( $this ) );
    }
    
    /**
     * Save()
     * Call to repositoriy for save user data
     * @return bool wheather is data saved
     */
    
    //Maybe thing about class
    public function Save() 
    {
        $isSaved = FALSE;
        $this -> SetTemplate( "User_OpenedAccount" );
        $Rep = $this -> Repositoriy;
        if ( TRUE == $Rep -> Save( $this -> User ) )
        {
            $isSaved = $Rep -> Save( $this );
        }
        
        return $isSaved;
    }

    /**
     * Create()
     * Call to repositoriy for fill data
     * @return bool wheather is account created
     */
    
    public function Create( $argc, $argv = "" ) 
    {
        $isCreated = FALSE;
        
        $obj = empty( $argc ) ? NULL : new $argc();
        $arg = explode( ",", $argv );
        
        if ( TRUE == $this -> Repositoriy -> Create( $obj, $arg ) )
        {
            empty( $argv ) 
                ? $this -> SetTemplate( "User_CreateAccount" )
                : $this -> SetTemplate( "User_OpenAccount" );
            
            $isCreated = TRUE;
        }
        
        return $isCreated;
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

    /**
     * toselfcopy()
     * Copy object to this class
     * @return null
     */

    public function toselfcopy( &$obj )
    {
        foreach ( $obj as $key => $value )
        {
            $this -> $key = $value;
        }
    }
}