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
        View:: Instance() -> tpl = '/Error/e404.tpl.php';
        $this -> assertTrue( View :: Instance() -> tpl(  ) );
    }
    
    function testBrowserToGetOutputData()
    {
        View:: Instance() -> tpl = '/Error/e404.tpl.php';
        $this -> assertTrue( View :: Instance() -> Output(  ) );
    }
}