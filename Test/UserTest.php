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
        $User = new User();
        
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
        $User = new User();
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
        $User = new User();
        $pid = [ 'id'=>1, 'name'=>'BestProject' ];
        $this -> assertInstanceOf( get_class( new Project() ), $User -> Project( $pid ) );
    }
 
    
    function testCanAcceptedProjectPidInLocalPool()
    {
        $User = new User();
        for($i = 0; $i < 5; $i++)
        {
            $Project = new Project();
            $this -> assertTrue( $User -> AcceptProjectPid( $Project ) );
            unset( $Project );
        }
    }
    
    function testCanDisclaimeProjectPidFromLocalPool()
    {
        $User = new User();
        $UA = [];
        for($i = 1; $i <= 5; $i++)
        {
            $Project = new Project();
            $Project -> Fill( ['id'=>$i, 'name'=>(float)$i/2] );
            $UA[] = $Project;
            $this -> assertTrue( $User -> AcceptProjectPid( $Project ) );
            unset( $Project );
        }
        for($i = 1; $i <= 2; $i++)
        {
            $this -> assertTrue( $User -> DisclaimeProjectPid( array_pop( $UA ) ) );
        }
        unset( $UA );
    }  
}