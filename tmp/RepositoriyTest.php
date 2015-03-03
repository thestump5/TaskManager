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
        $this -> assertTrue( $Repositoriy -> Save( new User() ) );
    }

    function testIsOpen()
    {
        $Repositoriy = new Repositoriy();
        $this -> assertTrue( $Repositoriy -> Open( new User() ) );
    }
  
    function testIsClose()
    {
        $Repositoriy = new Repositoriy();
        $this -> assertTrue( $Repositoriy -> Close( new User() ) );
    }
    
    function testIsCreate()
    {
        $Repositoriy = new Repositoriy();
        $this -> assertTrue( $Repositoriy -> Create( new User() ) );
    }    
}
