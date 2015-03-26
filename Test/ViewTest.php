<?php

namespace View;
/**
 * Description of Test_View
 *
 * @author Максим
 */

require_once '/../Model/View/View.class.php';

class ViewTest extends \PHPUnit_Framework_TestCase
{
    function testCanMakeOutputData()
    {
        $View =  View:: Instance();
        $View -> tpl = 'Error_e404';
        $this -> assertTrue( $View -> tpl(  ) );
    }
    
    function testBrowserToGetOutputData()
    {
        $View =  View:: Instance();
        $View -> tpl = 'Error_e404';
        $this -> assertTrue( $View -> Output(  ) );
    }
}