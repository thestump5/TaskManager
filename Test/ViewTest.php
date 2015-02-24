<?php

namespace View;
/**
 * Description of Test_View
 *
 * @author Максим
 */

require_once '/../Views/View/View.class.php';

class ViewTest extends \PHPUnit_Framework_TestCase
{
    function testCanMakeOutputData()
    {
        $View = View::Instance();
        //$View -> tpl = "/Error/e404.tpl.php";
        $this -> assertTrue( $View -> tpl(  ) );
    }
    
    function testBrowserToGetOutputData()
    {
        $View = View::Instance();
        $View -> tpl = "/Error/e404.tpl.php";
        $this -> assertTrue( $View -> Output(  ) );
    }
}