<?php

namespace User;
use Project\Project;
/**
 * Description of Test_CanTaskWorking
 *
 * @author Максим
 */

require_once '/../Model/Repositoriy/Repositoriy.class.php';
require_once '/../Model/User/User.class.php';
require_once '/../Model/User/Role.class.php';
require_once '/../Model/User/Account.class.php';

require_once '/../Model/Project/Project.class.php';

class UserTest extends \PHPUnit_Framework_TestCase
{
    function testCanFillDataSingleUser()
    {
        $User = User :: Instance();
        
        $this -> assertTrue( $User -> Fill( [ 'action'=>'test', 'id'=>'id', 
                                                'name'=>'name', 'family' => 'family', 
                                                'address'=>'address', 
                                                'attribute'=>[1]] ) );
        $this -> assertEquals( 'name', $User -> name );
    }

//    function testUserIsClose()
//    {
//        $User = new User();
//        $User -> name = 'name';
//        $this -> assertNotEmpty( $User -> name );
//        $this -> assertTrue( $User -> Close() );
//        $this -> assertObjectHasAttribute( 'name', $User );
//        
//    } 
    
//    function testCanReturnCurrentIdSingleUser()
//    {
//        $User = User :: Instance();
//        $User -> id = 1;
//        $this -> assertTrue( ( true == $User -> Current() ) );
//    }
    
    function testCanUserHaveAccount()
    {
        $User = User :: Instance();
        $this -> assertInstanceOf( get_class( new Account() ), $User -> Account()    );
    }
    
    function testCanUserChangeAccount()
    {
        $User1 = new User();
        $User2 = new User();
        
        $this -> assertInstanceOf( get_class( new Account() ), $User1 -> Account()    );
        $this -> assertInstanceOf( get_class( new Account() ), $User2 -> Account()    );
        
        $this -> assertEquals( $User2 -> Account(), $User1 -> Account( $User2 -> Account() ) );
    }    
    
    function testCanUserOpenProject()
    {
        $User = User :: Instance();
        $pid = [ 'id'=>1, 'name'=>'BestProject' ];
        $this -> assertInstanceOf( get_class( new Project() ), $User -> Project( $pid ) );
    }
 
    
    function testCanAcceptedProjectPidInLocalPool()
    {
        $User = User :: Instance();
        for($i = 0; $i < 5; $i++)
        {
            $Project = new Project();
            $this -> assertTrue( $User -> AcceptProjectPid( $Project ) );
        }
        
        $this -> assertEquals( 5, count( $User -> pidproject ) );
    }
    
    function testCanAddAttributeInPool()
    {
        $User = User :: Instance();
        $attribute = [];
        for($i = 0; $i < 5; $i++)
        {
            $this -> assertTrue( $User -> SetAttribute( $attribute = [$i, (float)$i / 2] ) );
        }
        
        $this -> assertContains( $attribute, $User -> attribute );
    }    
}