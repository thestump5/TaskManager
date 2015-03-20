<?php

namespace Repositoriy;
require_once '/../Model/User/User.class.php';
use User\User;
/**
 * Description of Test_CanTaskWorking
 *
 * @author Максим
 */

require_once '/../Model/Project/Project.class.php';
require_once '/../Model/Repositoriy/Repositoriy.class.php';

class RepositoriyTest extends \PHPUnit_Framework_TestCase
{
    function testIsSave()
    {
        $Repositoriy = Repositoriy::Instance();
        $User = $this -> getMockBuilder('User\User')
                      -> getMock();
        $User -> id = null;
        $User -> name = null;
        $User -> family = null;
        $User -> address = null;        

        $this -> assertTrue( $Repositoriy -> Save( $User ) );
    }

    function testIsSearched()
    {
        $Repositoriy = new Repositoriy();
        $this -> assertTrue( $Repositoriy -> Search( 1 ) );
    }
    
    function testIsFlushed()
    {
        $Repositoriy = new Repositoriy();
        $this -> assertTrue( $Repositoriy -> Flush( 1 ) );
    }
    
    function testIsDumped()
    {
        $Repositoriy = new Repositoriy();
        $this -> assertNotTrue( $Repositoriy -> Dump( 1 ) );
    }
    
    function testIsOpen()
    {
        $Repositoriy = new Repositoriy();
        $User = $this -> getMockBuilder('User\User')
                      -> getMock();
        $this -> assertNotTrue( $Repositoriy -> Open( $User ) );
    }
  
    function testIsClose()
    {
        $Repositoriy = new Repositoriy();
        $User = $this -> getMockBuilder('User\User')
                      -> getMock();
        $this -> assertTrue( $Repositoriy -> Close( $User ) );
    }
    
    function testIsCreate()
    {
        $Repositoriy = new Repositoriy();
        $Repositoriy -> Post = ['id'=>1, 'name'=>'name', 'family'=>'family', 'address'=>'address'];
        $User = $this -> getMockBuilder('User\User')
                      -> getMock();
        $this -> assertNotTrue( $Repositoriy -> Create( $User ) );
    } 
    
    function testCanDelete()
    {
        $Repositoriy = new Repositoriy();
        $User = $this -> getMockBuilder('User\User')
                      -> getMock();
        $this -> assertNotTrue( $Repositoriy -> Delete( $User ) );
    }
}