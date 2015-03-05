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

    function testIsCloseProject()
    {
        $Project = new Project();
        $pid = [ 'id'=>1, 'name'=>'BestProject' ];
        $this -> assertTrue( $Project -> Close( $pid ) );
    }    
    
    function testCanFillDataProject()
    {
        $Project = Project :: Instance();
        
        $this -> assertTrue( $Project -> Fill( [ 'id'=>'id', 'name'=>'name' ] ) );
        $this -> assertEquals( 'id', $Project -> id );
        $this -> assertEquals( 'name', $Project -> name );
    }   
    
    function testCanSetTaskToProject()
    {
        $Project = new Project();
        for($i = 0; $i < 5; $i++)
        {
            $Task = [1, 2, 3, 4, 5];
            $this -> assertTrue( $Project -> SetTask( $Task ) );
            unset( $Task );
        }
        
        $this -> assertEquals( 5, count( $Project -> Task ) );
    }
    
    function testCanMoveTaskToProject()
    {
        $Project = new Project();
        $P = [];
        for($i = 1; $i <= 5; $i++)
        {
            $Task = [1,2,3,4,5];
            $P[] = $Task;
            $this -> assertTrue( $Project -> SetTask( $Task ) );
            unset( $Task );
        }
        for($i = 1; $i <= 2; $i++)
        {
            $this -> assertTrue( $Project -> MoveTask( array_pop( $P ) ) );
        }
        $this -> assertEquals( 3, count( $Project -> Task ) );
        unset( $P );
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
