<?php

namespace Comments;
use Repositoriy\Repositoriy;

/**
 * Description of Task
 * @author Максим
 */

class Comments extends Message
{
    
    public $id;
    public $ansver;
    public $date;
    
    protected $User;    

    public function Create()
    {
        return ( TRUE == Repositoriy :: Instance() -> Create( $this ) );
    }
    
    public function Open()
    {
        return ( FALSE == Repositoriy :: Instance() -> Open( $this ) );
    }
    
    public function Close()
    {
        return ( TRUE == Repositoriy :: Instance() -> Close( $this ) );
    }
    
    public function Save()
    {
        return ( FALSE == Repositoriy :: Instance() -> Save( $this ) );
    }    

    public function AddMessage( $Message )
    {
        foreach ( $Message as $key => $message )
        {
            echo $key, $message, "<br />";
            $this -> $key = $message;
        }
        
        return ( FALSE == empty( $this -> text ) );
    }
 
    public function MoveMessage()
    {
        foreach ( $this as $key => $message )
        {
            echo $key, $this->$key, ":";
            $this -> $key = NULL;
            echo $key, $this->$key, "<br />";
        }

        return ( TRUE == empty( $this -> text ) );
    }
    
    public function AcceptUser( $User )
    {
        $this -> User  = $User;
        return ( FALSE == empty( $this -> User ) );      
    }
    
    public function DisclaimeUser( $User )
    {
        if ( $this -> User === $User )
        {
            $this -> User = NULL;
        }
        return ( TRUE == empty( $this -> User ) );
    }   
}