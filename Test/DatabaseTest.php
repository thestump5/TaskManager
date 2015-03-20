<?php

namespace Database;
/**
 * Description of Test_DatabaseTest
 * @author Максим
 */
require_once '/../Model/Database/PDO.class.php';
require_once '/../Model/Database/Database.class.php';
require_once '/../Model/Database/QueryBuilder.class.php';


class DatabaseTest extends \PHPUnit_Framework_TestCase
{    
    function testCanSQLIsBuild()
    {
        $Database = new Database();
        $Query = new QueryBuilder();
        $Query -> addpart( 'SELECT', "*" )
               -> addpart( 'FROM', 'user' )
               -> addpart( 'WHERE', ['id > 1', 'id < 10'] )
               -> addpart( 'LIMIT', [10] );
        
        $this -> assertTrue( $Database -> Build( $Query ) );
    }

    function testCanExecuteQuery()
    {
        $Database = new Database();
        $Database -> sql = "SELECT * FROM user";
        $this -> assertNotEmpty( $Database -> execute() );
    }    

    function testCanFetchResultQuery()
    {
        $Database = new Database();
        $Database -> sql = "SELECT * FROM user";
        $this -> assertInternalType( 'array', $Database -> query() );
    }
}
