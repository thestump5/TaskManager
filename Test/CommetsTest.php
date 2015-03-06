<?php

namespace Comments;
use User\User;
/**
 * Description of Test_CanCommentsWorking
 *
 * @author Максим
 */
require_once '/../Model/User/User.class.php';
require_once '/../Model/Comments/Comments.class.php';

class CommentsTest extends \PHPUnit_Framework_TestCase
{
    function testIsCommentsCreated()
    {
        $Comments = new Comments();
        $this -> assertTrue( $Comments -> Create() );
    }

    function testIsCommentsOpen()
    {
        $Comments = new Comments();
        $this -> assertTrue( $Comments -> Open() );
    }
    
    function testIsCommentsClose()
    {
        $Comments = new Comments();
        $this -> assertTrue( $Comments -> Close() );
    }
    
    function testIsCommentsSaved()
    {
        $Comments = new Comments();
        $this -> assertTrue( $Comments -> Save() );
    }

    function testIsAcceptedUser()
    {
        $Comments = new Comments();
        $this -> assertTrue( $Comments -> AcceptUser( ( new User() ) ) );
    }
    
    function testIsDisclaimeUser()
    {
        $Comments = new Comments();
        $this -> assertTrue( $Comments -> AcceptUser( ( $_User = new User() ) ) );
        $this -> assertTrue( $Comments -> DisclaimeUser( $_User ) );
    }
    
    function testCanAddMessage()
    {
        $Comments = new Comments();
        $this -> assertTrue( $Comments -> AddMessage( ['id'=>1, 'ansver'=>0, 'date'=>  microtime(true)] ) );
    }    
    
    function testCanMoveMessage()
    {
        $Comments = new Comments();
        $Comments -> AddMessage( ['id'=>1, 'ansver'=>0, 'date'=>  microtime(true)] );
        $this -> assertTrue( $Comments -> MoveMessage( ['id'=>1, 'ansver'=>0, 'date'=>  microtime(true)] ) );   
    }
}