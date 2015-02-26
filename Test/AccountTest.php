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
    function testCanReturnTemplate()
    {
        $Account = new Account( new User() );
        $Account -> SetTemplate( "Template" );
        $this -> assertNotEmpty( $Account -> GetTemplate() );
    }

    function testCanSetTemplate()
    {
        $Account = new Account( new User() );
        $this -> assertNotEmpty( $Account -> SetTemplate( "Template" ) );
    }
    
    function testCanCheckEqualseAccountUser()
    {
        $Account = new Account( new User() );
        $this -> assertInternalType( 'bool', $Account -> Check() );
    }
    
    function testcanOpenAccount()
    {
        $Account = new Account( new User() );
        $this -> assertNotEmpty( $Account -> GetTemplate() );
        $this -> assertTrue( $Account -> Open() );
    }
}
