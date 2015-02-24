<?php

namespace User;
require_once '/../project/Project/Project.class.php';
require_once '/../project/Task/Task.class.php';
use Project\Project;
use Task\Task;
/**
 * Description of Test_CanTaskWorking
 *
 * @author Максим
 */

require_once '/../project/User/User.class.php';

class UserTest extends \PHPUnit_Framework_TestCase
{
    function testIsAccepted()
    {
        $User = new User();
        
        $Task = new Task();
        $Project = new Project();
        
        $this -> assertTrue( $User -> Accepted( $Task, 'Task') );
        $this -> assertTrue( $User -> Accepted( $Project, 'Project') );
    }

    function testIsCurrentUser()
    {
        $User = User :: Instance();
        $User -> Open();
        $this -> assertNotEmpty( $User -> Current() );
    }

    function testCanUserHaveAccount()
    {
        $User = User :: Instance();
        $this -> assertInstanceOf( 'Account', $User -> Account() );
    }
    
    function testIsCreated()
    {
        $User = new User();

        $this -> assertTrue( $User -> Create( 'Maxim', 'Gavrilov', 'stump', 'Here') );
        
        $this -> assertNotEmpty( $User -> name );
        $this -> assertNotEmpty( $User -> family );
        $this -> assertNotEmpty( $User -> nic );
        $this -> assertNotEmpty( $User -> address );
    }
    
    function testIsOpened()
    {
        $User = new User();
        $this -> assertTrue( $User -> Open() );
    }

    function testIsSaved()
    {
        $User = new User();
        $this -> assertTrue( $User -> Save() );
        $this -> assertNotEmpty( $User -> id );
    }
}
