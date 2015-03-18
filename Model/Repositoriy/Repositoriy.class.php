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
        
        $where = ( FALSE == $where )
                    ? empty( $this -> Post ) ? 1 : $this -> Post
                    : $where;
        
        $Query -> addpart( 'SELECT', $obj )
               -> addpart( 'FROM', strtolower( substr( get_class( $obj ), strpos(get_class( $obj ), "\\" ) + 1 ) ) )
               -> addpart( 'WHERE', $where )
               -> addpart( 'LIMIT', [1] );
        $db -> Build( $Query );
        
        $opened = $db ->query();
        
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
    
    public function Save( &$obj )
    {
        $obj -> id = 1;
        return FALSE;
    }    
    
    public function Create( &$obj )
    {
        if ( !empty( $obj -> User ) )
        {
            $obj -> User -> Fill( $this -> Post );
        }
        return FALSE;
    }
    
    private function FillObject( &$obj, $stdClass )
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
