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
    public $accepted_user;
    public $link_project;
    
    protected $Comments;

    
    public function __construct() 
    {
        ;
    }

    public function Create( $description, $user_story, $date, $status )
    {
        $this -> description = $description;
        $this -> user_story = $user_story;
        $this -> date = $date;
        $this -> status = $status;
        
        return TRUE;
    }
    
    public function Save()
    {
        Repositoriy :: Instance() -> Save ( $this );
        return TRUE;
    }
    
    //Visualtest function
    public function Flush()
    {
        foreach ($this as $var => $value)
        {
            if ( empty( $value ) ) 
            {
                continue;
            }
                
            echo $var . ' = ' . $value;
            echo '<br />';
        }
    }
    
    public function AcceptedUser()
    {
        $User = User :: Instance();
        //$User -> Open();//Temp! Open is Gen id.
        $User -> Accepted( $this, 'Task' );
        $this -> accepted_user = $User -> Current();
        return ($this -> accepted_user == TRUE);
    }
    
    public function AssumeProject()
    {
        //Project :: Instance() -> Open();//Temp! Open is Gen id.
        $this -> link_project = Project :: Instance() -> Current();
        return TRUE;
    }
            
    public function __set($name, $value) 
    {
        $this -> $name = $value;
    }



}