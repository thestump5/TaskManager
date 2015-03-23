<?php

namespace User;
/**
 * Description of Test_AccountTest
 * @author Максим
 */


require_once '/../Model/User/Role.class.php';

require_once '/../Model/User/Account.class.php';
require_once '/../Model/User/User.class.php';

class AccountTest extends \PHPUnit_Framework_TestCase
{
    //TODO: refactoring this test
    function testCanOpenAccount()
    {
        $Account = new Account();
        
        $User = new User();
        $Account -> setUser( $User );
        
        $this -> assertTrue( $Account -> Open() );
        $this -> assertNotEmpty( $Account -> id );
    }    

    function testAccountIsClose()
    {
        $Account = new Account();
        $User = new User();
        $Account -> setUser( $User );
        $this -> assertTrue( $Account -> Close() );
    }    

    function testAccountIsSave()
    {
        $Account = new Account();
        $User = new User();
        $Account -> setUser( $User );
        $Account -> Open();
        $this -> assertTrue( $Account -> Save() );
    }    

    function testAccountIsCreate()
    {
        $Account = new Account();
        $std = new \stdClass();
        $std -> id = -1;
        $std -> pw = 'pw';
        $std -> attribute = 'attr';
        $this -> assertTrue( $Account -> Create( $Account, $std ) );
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