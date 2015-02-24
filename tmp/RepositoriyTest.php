<?php

namespace Repositoriy;
require_once '/../project/Task/Task.class.php';
use Task\Task;
/**
 * Description of Test_CanTaskWorking
 *
 * @author Максим
 */

require_once '/../project/Repositoriy/Repositoriy.class.php';

class RepositoriyTest extends \PHPUnit_Framework_TestCase
{
    function testIsSave()
    {
        $Repositoriy = new Repositoriy();
        $Task = new Task();
        $this -> assertTrue( $Repositoriy -> Save( $Task ) );
    }

    function testIsOpen()
    {
        $Repositoriy = new Repositoriy();
        $Task = new Task();
        $this -> assertTrue( $Repositoriy -> Open( $Task ) );
    }
    
}
