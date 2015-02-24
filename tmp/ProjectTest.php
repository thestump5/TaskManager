<?php

namespace Project;
require_once '/../project/User/User.class.php';
use User\User;
/**
 * Description of Test_CanTaskWorking
 *
 * @author Максим
 */

require_once '/../project/Project/Project.class.php';

class ProjectTest extends \PHPUnit_Framework_TestCase
{
    function testIsOpenedProject()
    {
        $Project = new Project();
        $this -> assertTrue( $Project -> Open() );
    }
    
    function testIsClosedProject()
    {
        $Project = new Project();
        $this -> assertTrue( $Project -> Close() );
    }
    
    function testIsCreatedProject()
    {
        $Project = new Project();
        $Project -> Create( 'Task manager' );
        $this -> assertNotEmpty( $Project -> name );
    }
     
    
    function testIsIssetCurrentProject()
    {
        $Project = new Project();
        $Project -> Open();
        $this -> assertNotEmpty( $Project -> Current() );
    }

    function testIsAcceptUserToCommand()
    {
        $Project = new Project();
        $User = new User();

        $this -> assertTrue( $Project -> AcceptToCommand( $User ) );
    }

    
}
