<?php

namespace Comments;
use Repositoriy\Repositoriy;

/**
 * Description of Task
 *
 * @author Максим
 */

class Comments
{
    
    public $id;
    public $ansver;
    public $date;
    
    protected $User;
    public $Message = [];
    

    public function Create()
    {
        return ( FALSE == Repositoriy :: Instance() -> Create( $this ) );
    }
    
    public function Open()
    {
        return ( FALSE == Repositoriy :: Instance() -> Open( $this ) );
    }
    
    public function Close()
    {
        return ( FALSE == Repositoriy :: Instance() -> Close( $this ) );
    }
    
    public function Save()
    {
        return ( FALSE == Repositoriy :: Instance() -> Save( $this ) );
    }    

    public function AddMessage( $_Message )
    {
        $count = count( $this -> Message );
        $ncount = array_push( $this -> Message, $_Message );
        return ( ( $count + 1 ) == $ncount );
    }
 
    public function MoveMessage( $_Message )
    {
        $count = count( $this -> Message );
        if ( TRUE !== ( $key = array_search( $_Message, $this -> Message ) ) )
        {
            unset( $this -> Message[ $key ] );
        }
        return ( ( $count - 1 ) == ( count( $this -> Message ) ) );
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