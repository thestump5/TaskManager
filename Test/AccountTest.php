<?php

namespace User;
/**
 * Description of Test_CanTaskWorking
 *
 * @author Максим
 */

require_once '/../Model/User/User.class.php';
require_once '/../Model/User/Account.class.php';

class AccountTest extends \PHPUnit_Framework_TestCase
{
    function testCanReturnTemplate()
    {
        $Account = new Account( new User() );
        $this -> assertNotEmpty( "Template" );
    }

    function testCanSetTemplate()
    {
        $Account = new Account( new User() );
        $Account -> SetTemplate( "Template" );
        $this -> assertNotEmpty( $Account -> GetTemplate() );
    }
    
    
    function testCanCheckEqualseAccountUser()
    {
        $Account = new Account( new User() );
        $this -> assertInternalType( 'bool', $Account -> Check() );
    }
}
