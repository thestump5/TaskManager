<?php

namespace Repositoriy;
/**
 * Description of Test_CanTaskWorking
 *
 * @author Максим
 */

require_once '/../Model/Repositoriy/Strict.class.php';

class StrictTest extends \PHPUnit_Framework_TestCase
{
    function testIsStricted()
    {
        $Strict = new Strict();
        $this -> assertTrue( $Strict -> Strict(  ) );
    }

    function testIsGranted()
    {
        $Strict = new Strict();
        $this -> assertTrue( $Strict -> Grant(  ) );
    }    
}
