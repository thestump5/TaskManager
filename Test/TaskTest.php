<?php

namespace Task;
use User\User;
/**
 * Description of Test_CanTaskWorking
 *
 * @author Максим
 */
require_once '/../Model/User/User.class.php';
require_once '/../Model/Task/Task.class.php';

class TaskTest extends \PHPUnit_Framework_TestCase
{
    function testIsTaskCreated()
    {
        $Task = new Task();
                
//        $this -> assertTrue( $Task -> Create() );
        
//        $this -> assertNotEmpty( $Task -> description );
//        $this -> assertNotEmpty( $Task -> user_story );
//        $this -> assertNotEmpty( $Task -> date );
//        $this -> assertNotEmpty( $Task -> status );
    }

    function testIsTaskOpen()
    {
        $Task = new Task();
        $this -> assertTrue( $Task -> Open() );
    }
    
    function testIsTaskClose()
    {
        $Task = new Task();
        $this -> assertTrue( $Task -> Close() );
    }
    
    function testIsTaskSaved()
    {
        $Task = new Task();
//        $this -> assertTrue( $Task -> Save() );
    }

    function testCanAddComments()
    {
        $Task = new Task();
        $this -> assertTrue( $Task -> AddComments( ['id'=>1, 'ansver'=>0, 'date'=>  microtime(true)] ) );
    }    
    
    function testCanShowDialog()
    {
        $Task = new Task();
        $Task -> Dialog = [
                            ['id'=>1, 'ansver'=>0, 'date'=>  microtime(true)],
                            ['id'=>2, 'ansver'=>0, 'date'=>  microtime(true)],
                            ['id'=>3, 'ansver'=>0, 'date'=>  microtime(true)],
                            ['id'=>4, 'ansver'=>0, 'date'=>  microtime(true)],
                            ['id'=>5, 'ansver'=>0, 'date'=>  microtime(true)]
                           ];
        $this -> assertInternalType( 'array', $dlg = $Task -> ShowDialog() );        
        $this -> assertNotEmpty( $dlg );        
    }
    
    function testIsAcceptedUser()
    {
        $Task = new Task();
        $this -> assertTrue( $Task -> AcceptUser( ( new User() ) ) );
    }
    
    function testIsDisclaimeUser()
    {
        $Task = new Task();
        $this -> assertTrue( $Task -> AcceptUser( ( $_User = new User() ) ) );
        $this -> assertTrue( $Task -> DisclaimeUser( $_User ) );
    }
     
    function testCanChangeStatus()
    {
        $Task = new Task();
        $this -> assertTrue( $Task -> ChangeStatus( 'in progress' ) );
    }
    
    function testcanSetComplexity()
    {
        $Task = new Task();
        $this -> assertTrue( $Task -> SetComplexity( 'midle' ) );
    }    
//    function testIsAcceptedUserReturnPointer()
//    {
//        $Task = new Task();
//        $this -> assertTrue( $Task -> AcceptedUser() );
//        $this -> assertNotEmpty( $Task -> accepted_user );
//    }
//
//    function testIsAssumeProjectReturnPointer()
//    {
//        $Task = new Task();
//        $this -> assertTrue( $Task -> AssumeProject() );
//        $this -> assertNotEmpty( $Task -> link_project );
//    }


    
}