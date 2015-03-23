<?php
/**
 * TODO:
 * посмотреть паттерны состояния, цепочка обязанностей и др.
 */

namespace Repositoriy;
use Database\Database,
    Database\QueryBuilder;
/**
 * Description of Repositoriy
 * release pattern Repositoriy
 * @author Максим
 */

class Repositoriy 
{
    public $repositoriy = [];
    public $filter;
    
    public static $Instance;
    
    public static function Instance()  
    {
       if ( empty( static :: $Instance ))
       {
           static :: $Instance = new Repositoriy();
       }
       
       return static :: $Instance;
    }
    
    public function Open( &$obj )
    {
        $db = new Database();
        $Query = new QueryBuilder();
        
        empty( $this -> filter ) ? $this -> setFilter() : TRUE;
        
        $Query -> addpart( 'SELECT', $obj )
               -> addpart( 'FROM', strtolower( substr( get_class( $obj ), strpos(get_class( $obj ), "\\" ) + 1 ) ) )
               -> addpart( 'WHERE', $this -> filter )
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
        $this -> filter = NULL;
        $obj = NULL;
        return ( TRUE == ( empty( $obj ) && empty( $this -> filter ) ) );
    }

    //What is array to where clause?
    public function Save( &$obj )
    {
        $db = new \Database\Database();
        $Query = new \Database\QueryBuilder();
        
        $param = array_values( get_object_vars( $obj ) );
        $values = [];
        
        for ($i=0; $i < count( get_object_vars( $obj ) ); $i++)
        {
            $values[] = '?';
        }
        
        $Query -> key_exclude[] = "SET";
        
        $Query -> addpart( 'INSERT INTO', strtolower( substr( get_class( $obj ), strpos(get_class( $obj ), "\\" ) + 1 ) ) )
               -> addpart( 'FIELD', $obj)
               -> addpart( 'VALUES', $values )
               -> addpart( 'ON DUPLICATE KEY' )
               -> addpart( 'UPDATE' )
               -> addpart( 'SET', get_object_vars( $obj ) );
        $db -> Build( $Query );     

        $db -> param = $param;

        $isSaved = $db -> execute();
        
        $obj -> id = $db -> lastId();
        
        return $isSaved;
    }    
    
    public function Search()
    {
        return TRUE;
    }
    
    public function Flush()
    {
        return TRUE;
    }
    
    public function Dump()
    {
        ;
    }
    
    public function Delete( &$obj )
    {
        $db = new \Database\Database();
        $Query = new \Database\QueryBuilder();
        
        $Query -> addpart( 'DELETE' )
               -> addpart( 'FROM', strtolower( substr( get_class( $obj ), strpos(get_class( $obj ), "\\" ) + 1 ) ) )
               -> addpart( 'WHERE', ['id'=>$obj->id] );
        $db -> Build( $Query );     

        return $db -> execute();
    }
    
    public function Create( &$obj, $stdClass = NULL )
    {
        $this -> FillObject( $obj, $stdClass );
        return $this -> Save( $obj );
    }
    
    private function FillObject( &$obj, $stdClass = NULL )//untested this
    {
        if ( empty( $stdClass ) )
        {
            if ( empty( $_POST ) )
            {
                $stdClass = array();
            }
            else
            {
                $stdClass = $_POST;
            }
        }
        else
        {
            if ( is_array( $stdClass ) )
            {
                $stdClass = $stdClass;
            }
            else
            {
                $stdClass = get_object_vars( $stdClass );
            }
        }
        
        if ( !empty ( array_diff( array_keys( get_object_vars( $obj ) ), 
                        array_keys( $stdClass ) ) ) )
        {
            //throw new \Exception("Operation failed: classes difirent");
            return FALSE;
        }
                
        foreach ( $stdClass as $key=>$value )
        {
            $obj -> $key = $value;
        }
        
        return TRUE;
    }
    
    public function setFilter( $filter = NULL )
    {
        $this -> filter = empty( $filter )
                           ? empty( $_POST ) ? [1=>1] : $_POST
                           : $filter;
    }
}
