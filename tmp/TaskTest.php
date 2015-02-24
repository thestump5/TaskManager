<?php

namespace Task;
/**
 * Description of Test_CanTaskWorking
 *
 * @author Максим
 */

require_once '/../project/Task/Task.class.php';

class TaskTest extends \PHPUnit_Framework_TestCase
{
    function testIsTaskCreated()
    {
        $Task = new Task();
                
        $this -> assertTrue( $Task -> Create('Project', 'Create project', 'date', 'status') );
        
        $this -> assertNotEmpty( $Task -> description );
        $this -> assertNotEmpty( $Task -> user_story );
        $this -> assertNotEmpty( $Task -> date );
        $this -> assertNotEmpty( $Task -> status );
    }

    function testIsTaskSaved()
    {
        $Task = new Task();
        
        $this -> assertTrue( $Task -> Save() );
        $this -> assertNotEmpty( $Task -> id );
    }
    
    
    function testIsAcceptedUserReturnPointer()
    {
        $Task = new Task();
        $this -> assertTrue( $Task -> AcceptedUser() );
        $this -> assertNotEmpty( $Task -> accepted_user );
    }

    function testIsAssumeProjectReturnPointer()
    {
        $Task = new Task();
        $this -> assertTrue( $Task -> AssumeProject() );
        $this -> assertNotEmpty( $Task -> link_project );
    }


    
}