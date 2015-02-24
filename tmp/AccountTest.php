<?php

namespace User;
/**
 * Description of Test_CanTaskWorking
 *
 * @author Максим
 */

require_once '/../project/User/Account.class.php';

class AccountTest extends \PHPUnit_Framework_TestCase
{
    function testCanCheckEqualseAccountUser()
    {
        $Account = new Account( new User() );
        $this -> assertInternalType( 'bool', $Account -> Check() );
    }
    
    function testCanOpenAccoutForCurrentUser()
    {
        $User = User :: Instance();
        $User -> Open();
        
        $Account = new Account( $User );
        $this -> assertTrue( $Account -> Open() );
    }
}
