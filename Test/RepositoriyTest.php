<?php

namespace Repositoriy;
require_once '/../Model/User/User.class.php';
use User\User;
/**
 * Description of Test_CanTaskWorking
 *
 * @author Максим
 */
require_once '/../Model/Database/PDO.class.php';
require_once '/../Model/Database/QueryBuilder.class.php';

require_once '/../Model/Database/Database.class.php';
require_once '/../Model/Repositoriy/Repositoriy.class.php';

class RepositoriyTest extends \PHPUnit_Framework_TestCase
{
    function testIsSave()
    {
        $Repositoriy = Repositoriy::Instance();
        $User = new User();
        $User -> Fill( ['name'=>'name', 'family'=>'family', 'address'=>'address'] );
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
        $User = new User();
        $this -> assertTrue( $Repositoriy -> Open( $User ) );
    }
  
    function testIsClose()
    {
        $Repositoriy = new Repositoriy();
        $User = new User();
        $this -> assertTrue( $Repositoriy -> Close( $User ) );
    }
    
    function testIsCreate()
    {
        $Repositoriy = new Repositoriy();
        $std = ['id'=>1, 'name'=>'name', 'family'=>'family', 'address'=>'address'];
        $User = new User();
        $this -> assertTrue( $Repositoriy -> Create( $User, "", $std ) );
    } 
    
    function testCanDelete()
    {
        $Repositoriy = new Repositoriy();
        $User = new User();
        $User->Fill( ['id'=>10, 'name'=>'0', 'family'=>'0', 'address'=>'0'] );
        $this -> assertTrue( $Repositoriy -> Delete( $User ) );
    }
}