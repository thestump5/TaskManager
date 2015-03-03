<?php

namespace User;
/**
 * Description of Test_CanTaskWorking
 *
 * @author Максим
 */

require_once '/../Helpers/Interface/ICommand/Command.interface.php';
require_once '/../Model/User/User.class.php';
require_once '/../Model/User/Account.class.php';

class AccountTest extends \PHPUnit_Framework_TestCase
{
    function testCanOpenAccount()
    {
        $Account = new Account();
        $this -> assertTrue( $Account -> Open() );
    }    

    function testAccountUserIsClose()
    {
        $Account = new Account();
        $this -> assertTrue( $Account -> Close() );
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
