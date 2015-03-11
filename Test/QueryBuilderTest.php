<?php

namespace Database;
/**
 * Description of Test_CanTaskWorking
 *
 * @author Максим
 */
require_once '/../Model/Database/QueryBuilder.class.php';
require_once '/../Model/Database/Database.class.php';
require_once '/../Model/Database/PDO.class.php';

class QueryBuilderTest extends \PHPUnit_Framework_TestCase
{
    function testCanFieldAdded()
    {
        $Query = new QueryBuilder();
        $key = 'join';
        $value = [ 'uin', 'uin.iduin=delivery.iduin' ];
        $Query -> addfield( $key , $value );
        $this -> assertContains( $value, $Query -> field[$key] );
    } 
    
    function testCanApplyedSQLQuery()
    {
        $Query = new QueryBuilder();
        $this -> assertTrue( $Query -> apply() );
    } 
}
