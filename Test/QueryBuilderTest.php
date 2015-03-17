<?php

namespace Database;
/**
 * Description of Test_QueryBuilderTest
 *
 * @author Максим
 */
require_once '/../Model/Database/QueryBuilder.class.php';

class QueryBuilderTest extends \PHPUnit_Framework_TestCase
{
    function testCanFieldAdded()
    {
        $Query = new QueryBuilder();
        $key = 'SELECT';
        $value = [ '*' ];
        $Query -> addpart( $key , $value );
        $this -> assertContains( $value, $Query -> field[ $key ] );
    } 
    
    function testCanApplyedSQLQuery()
    {
        $Query = new QueryBuilder();
        $Query -> addpart( "INSERT INTO", $Query );
        $this -> assertTrue( $Query -> apply() );
    } 
}