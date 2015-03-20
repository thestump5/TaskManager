<?php

namespace Comments;
/**
 * Description of Test_CommentsTest
 * @author Максим
 */

require_once '/../Model/Comments/Message.class.php';
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
        $User = $this -> getMock( 'User\User' );
        $this -> assertTrue( $Comments -> AcceptUser( $User ) );
    }
    
    function testIsDisclaimeUser()
    {
        $Comments = new Comments();
        $User = $this -> getMock( 'User\User' );
        $this -> assertTrue( $Comments -> AcceptUser( $User ) );
        $this -> assertTrue( $Comments -> DisclaimeUser( $User ) );
    }
    
    function testCanAddMessage()
    {
        $Comments = new Comments();
        $this -> assertTrue( $Comments -> AddMessage( ['id' => 1, 'ansver' => 0, 'date' =>  microtime(true), 'text' => 'hello'] ) );
    }    
    
    function testCanMoveMessage()
    {
        $Comments = new Comments();
        $Comments -> AddMessage( ['id' => 1, 'ansver' => 0, 'date' =>  microtime(true), 'text' => 'hello'] );
        $this -> assertTrue( $Comments -> MoveMessage() );   
    }
}