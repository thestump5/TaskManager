<?php

namespace User;
/**
 * Description of Test_CanTaskWorking
 *
 * @author Максим
 */
require_once '/../Helpers/Interface/ICommand/Command.interface.php';
require_once '/../Model/Repositoriy/Repositoriy.class.php';
require_once '/../Model/User/User.class.php';
require_once '/../Model/User/Account.class.php';

class UserTest extends \PHPUnit_Framework_TestCase
{
    function testCanCreateSingleUser()
    {
        $User = User :: Instance();
        
        $this -> assertTrue( $User -> Create( ['id'=>'id', 'name'=>'name', 
                                                'family' => 'family', 
                                                'address'=>'address', 
                                                'atribute'=>[1]] ) );
        $this -> assertEquals( 'name', $User -> name );
    }

    function testCanReturnCurrentIdSingleUser()
    {
        $User = User :: Instance();
        $User -> id = 1;
        $this -> assertTrue( ( true == $User -> Current() ) );
    }
    
    function testCanUserHaveAccount()
    {
        $User = User :: Instance();
        $this -> assertInstanceOf( get_class( new Account( $User ) ), $User -> Account()    );
    }
}