<?php

namespace Task;

use User\User;
use Project\Project;
use Repositoriy\Repositoriy;

/**
 * Description of Task
 * 
 * @author Максим
 */


class Task 
{
    
    public $id;
    public $description;
    public $user_story;
    public $date;
    public $status;
    public $complexity;
    
    protected $User;
    public $Dialog = [];
    
    /**
     * Меня беспокоит наличие методов Open,Close,Save,Create
     * в каждом классе. Возможно есть смысл создать трейт который 
     * будет реализовывать эти методы.
     */
    
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

    public function AddComments( $_Comments )
    {
        $count = count( $this -> Dialog );
        $ncount = array_push( $this -> Dialog, $_Comments );
        return ( ( $count + 1 ) == $ncount );
    }
    
    public function ShowDialog()
    {
        $_Dialog = [];
        foreach ($this -> Dialog as $Dialog)
        {
            $_Dialog[] = [$Dialog['id'], $Dialog['ansver'], $Dialog['date'], 
                          //$Dialog['User'] -> name, $Dialog['Message'] -> text //commets tmp
                         ];
        }
        return $_Dialog;
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
    
    public function ChangeStatus( $status )
    {
        $_status = $this -> status;
        if ( FALSE == empty($status) )
        {
            $this -> status = $status;
        }
        
        return ( $_status !== $this -> status );
    }

    //Combine with ChangeStatus
    public function SetComplexity( $complexity )
    {
        $_complexity = $this -> complexity;
        if ( FALSE == empty($complexity) )
        {
            $this -> complexity = $complexity;
        }
        
        return ( $_complexity !== $this -> complexity );
    }    
    
//    //Visualtest function
//    public function Flush()
//    {
//        foreach ($this as $var => $value)
//        {
//            if ( empty( $value ) ) 
//            {
//                continue;
//            }
//                
//            echo $var . ' = ' . $value;
//            echo '<br />';
//        }
//    }
//    
//    public function AcceptedUser()
//    {
//        $User = User :: Instance();
//        //$User -> Open();//Temp! Open is Gen id.
//        $User -> Accepted( $this, 'Task' );
//        $this -> accepted_user = $User -> Current();
//        return ($this -> accepted_user == TRUE);
//    }
//    
//    public function AssumeProject()
//    {
//        //Project :: Instance() -> Open();//Temp! Open is Gen id.
//        $this -> link_project = Project :: Instance() -> Current();
//        return TRUE;
//    }
//
//

}