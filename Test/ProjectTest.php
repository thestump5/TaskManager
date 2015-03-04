<?php

namespace Project;
require_once '/../Model/User/User.class.php';
use User\User;
/**
 * Description of Test_CanTaskWorking
 *
 * @author Максим
 */

require_once '/../Model/Project/Project.class.php';

class ProjectTest extends \PHPUnit_Framework_TestCase
{
    function testIsOpenedProject()
    {
        $Project = new Project();
        $pid = [ 'id'=>1, 'name'=>'BestProject' ];
        $this -> assertTrue( $Project -> Open( $pid ) );
    }

    function testCanFillDataProject()
    {
        $Project = Project :: Instance();
        
        $this -> assertTrue( $Project -> Fill( [ 'id'=>'id', 'name'=>'name'] ) );
        $this -> assertEquals( 'id', $Project -> id );
        $this -> assertEquals( 'name', $Project -> name );
    }   
    
    
//    function testIsClosedProject()
//    {
//        $Project = new Project();
//        $this -> assertTrue( $Project -> Close() );
//    }
//    
//    function testIsCreatedProject()
//    {
//        $Project = new Project();
//        $Project -> Create( 'Task manager' );
//        $this -> assertNotEmpty( $Project -> name );
//    }
//     
//    
//    function testIsIssetCurrentProject()
//    {
//        $Project = new Project();
//        $Project -> Open();
//        $this -> assertNotEmpty( $Project -> Current() );
//    }
//
//    function testIsAcceptUserToCommand()
//    {
//        $Project = new Project();
//        $User = new User();
//
//        $this -> assertTrue( $Project -> AcceptToCommand( $User ) );
//    }
}
