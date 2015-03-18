<?php

namespace Repositoriy;
require_once '/../Model/User/User.class.php';
use User\User;
/**
 * Description of Test_CanTaskWorking
 *
 * @author Максим
 */

require_once '/../Model/Repositoriy/Repositoriy.class.php';

class RepositoriyTest extends \PHPUnit_Framework_TestCase
{
    function testIsSave()
    {
        $Repositoriy = new Repositoriy();
        $User = $this -> getMock( 'User\User' );
        $this -> assertNotTrue( $Repositoriy -> Save( $User ) );
    }

    function testIsOpen()
    {
        $Repositoriy = new Repositoriy();
        $User = $this -> getMock( 'User\User' );
        $this -> assertNotTrue( $Repositoriy -> Open( $User ) );
    }
  
    function testIsClose()
    {
        $Repositoriy = new Repositoriy();
        $User = $this -> getMock( 'User\User' );
        $this -> assertTrue( $Repositoriy -> Close( $User ) );
    }
    
    function testIsCreate()
    {
        $Repositoriy = new Repositoriy();
        $User = $this -> getMock( 'User\User' );
        $this -> assertNotTrue( $Repositoriy -> Create( $User ) );
    }    
}
