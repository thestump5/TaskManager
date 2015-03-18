<?php

namespace User;
/**
 * Description of Test_CanTaskWorking
 *
 * @author Максим
 */

require_once '/../Model/User/User.class.php';
require_once '/../Model/User/Role.class.php';
require_once '/../Model/User/Account.class.php';

class AccountTest extends \PHPUnit_Framework_TestCase
{
    function testCanOpenAccount()
    {
        $Account = new Account();
        $Account -> setUser( $this -> getMock( 'User\User' ) );
        $this -> assertTrue( $Account -> Open() );
        $this -> assertNotEmpty( $Account -> id );
    }    

    function testAccountIsClose()
    {
        $Account = new Account();
        $Account -> setUser( $this -> getMock( 'User\User' ) );
        $this -> assertTrue( $Account -> Close() );
    }    

    function testAccountIsSave()
    {
        $Account = new Account();
        $Account -> setUser( $this -> getMock( 'User\User' ) );
        $this -> assertTrue( $Account -> Save() );
        $this -> assertNotEmpty( $Account -> id );
    }    

    function testAccountIsCreate()
    {
        $Account = new Account();
        $Account -> setUser( $this -> getMock( 'User\User' ) );
        $_POST['name'] = 'name';
        $this -> assertTrue( $Account -> Create() );
    }    
    
    function testCanCheckEqualseAccountUser()
    {
        $Account = new Account();
        $this -> assertInternalType( 'bool', $Account -> Check() );
    }
    
    function testCanReturnTemplate()
    {
        $Account = new Account();
        $Account -> SetTemplate( "Template" );
        $this -> assertNotEmpty( $Account -> GetTemplate() );
    }

    function testCanSetTemplate()
    {
        $Account = new Account();
        $this -> assertNotEmpty( $Account -> SetTemplate( "Template" ) );
    }
}