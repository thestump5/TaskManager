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
        $this -> assertNotEmpty( $Query -> addfield( 'join' , [ 'uin', 'uin.iduin=delivery.iduin' ] ) );
        $this -> assertInternalType( 'array', $Query -> field );
    }  
}
