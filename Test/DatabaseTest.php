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

    function testCanExecuteQuery()
    {
        $Database = new Database();
        $Query = $Database -> Build();
        $Database ->apply( $Query );
        $this -> assertNotEmpty( $Database -> sql );
        $this -> assertNotInternalType( 'string', $exe = $Database -> execute() );
        $this -> assertTrue( $exe );
    }    

    function testCanFetchResultQuery()
    {
        $Database = new Database();
        $Query = $Database -> Build();
        $Database ->apply( $Query );
        $this -> assertNotEmpty( $Database -> sql );
        $this -> assertNotInternalType( 'string', $exe = $Database -> query() );
        $this -> assertNotEmpty( $exe );
    }
}
