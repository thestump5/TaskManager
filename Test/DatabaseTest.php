<?php

namespace Database;
/**
 * Description of Test_CanTaskWorking
 *
 * @author Максим
 */

require_once '/../Model/Database/Database.class.php';
require_once '/../Model/Database/PDO.class.php';

class DatabaseTest extends \PHPUnit_Framework_TestCase
{
    function testCanSQLIsBuild()
    {
        $Database = new Database();
        $this -> assertInstanceOf( 'Database\QueryBuilder', $Database -> Build() );
    }

    function testCanApplySQLQuery()
    {
        $Database = new Database();
        $Query = $Database -> Build();
        $this -> assertInternalType( 'string', $Database -> apply( $Query ) );
    }
    
    function testCanExecuteQuery()
    {
        $Database = new Database();
        $Query = $Database -> Build()
                -> addpart( "SELECT", $Database );
        $Database ->apply( $Query );
        $this -> assertNotEmpty( $Database -> sql );
        $this -> assertNotInternalType( 'string', $Database -> execute() );
    }    

    function testCanFetchResultQuery()
    {
        $Database = new Database();
        $Query = $Database -> Build()
                -> addpart( "SELECT", $Database );
        $Database ->apply( $Query );
        $this -> assertNotEmpty( $Database -> sql );
        $this -> assertNotInternalType( 'string', $Database -> query() );
    }
}
