<?php

namespace Repositoriy;
use Database\Database,
    Database\QueryBuilder;
/**
 * Description of TaskRepositoriy
 *
 * @author Максим
 */

class Repositoriy 
{
    public $repositoriy;
    
    protected $Task;
    protected $Project;
    
    public static $Instance;
    
    public $Post;
    
    function __construct() 
    {
        if ( empty( $this -> Post ) )
        {
            $this -> Post = &$_POST;
        }
    }
    
    public static function Instance()  
    {
       if ( empty( self :: $Instance ))
       {
           self :: $Instance = new Repositoriy();
       }
       
       return self :: $Instance;
    }
    
    public function Open( &$obj, $where = FALSE )
    {
        $db = new Database();
        $Query = new QueryBuilder();
        
        //Why this?
        $where = ( FALSE == $where )
                    ? empty( $this -> Post ) ? 1 : $this -> Post
                    : $where;
        
        $Query -> addpart( 'SELECT', $obj )
               -> addpart( 'FROM', strtolower( substr( get_class( $obj ), strpos(get_class( $obj ), "\\" ) + 1 ) ) )
               -> addpart( 'WHERE', $where )
               -> addpart( 'LIMIT', [1] );
        $db -> Build( $Query );
        
        $opened = $db ->query();
        
        //It's trash!
        if ( !isset( $opened[0] ) )
        {
            return FALSE;
        }
        
        $this ->FillObject( $obj, $opened[0] );
        
        return ( FALSE == empty( $obj ) );
    }

    public function Close( &$obj )
    {
        unset( $this -> Post );
        unset( $obj );
        return ( TRUE == ( empty( $obj ) && empty( $this -> Post ) ) );
    }

    //What is array to where clause?
    public function Save( &$obj, $where = false )
    {
        $db = new \Database\Database();
        $Query = new \Database\QueryBuilder();
        
        $param = array_values( get_object_vars( $obj ) );
        $values = [];
        
        for ($i=0; $i < count( get_object_vars( $obj ) ); $i++)
        {
            $values[] = '?';
        }

        $where = ( FALSE == $where )
                    ? empty( $this -> Post ) ? 1 : $this -> Post
                    : $where;
        
        $Query -> key_exclude[] = "SET";
        
        $Query -> addpart( 'INSERT INTO', strtolower( substr( get_class( $obj ), strpos(get_class( $obj ), "\\" ) + 1 ) ) )
               -> addpart( 'FIELD', $obj)
               -> addpart( 'VALUES', $values )
               -> addpart( 'ON DUPLICATE KEY' )
               -> addpart( 'UPDATE' )
               -> addpart( 'SET', get_object_vars( $obj ) );
        $db -> Build( $Query );     

        $db -> param = $param;

        return $db -> execute();
    }    
    
    public function Create( &$obj )
    {
        $this -> FillObject( $obj, $this -> Post );
        return ( FALSE == empty( $obj ) );
    }
    
    private function FillObject( &$obj, $stdClass )//untested this
    {
        if ( !empty ( array_diff( array_keys( get_object_vars( $obj ) ), 
                        array_keys( get_object_vars( $stdClass ) ) ) ) )
        {
            throw new \Exception("Operation failed: classes difirent");
        }
        
        foreach ( $stdClass as $key=>$value )
        {
            $obj -> $key = $value;
        }
    }
}
