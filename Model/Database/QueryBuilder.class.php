<?php

namespace Database;

/**
 * Description of QueryBuilder
 * @author Максим
 */
class QueryBuilder 
{
    public $sql;
    public $field = [];
    
    private static $Instance;
    
    function __construct() 
    {
        static :: $Instance = $this;
    }
    
    public function select( $object )
    {
        $this -> field[ "SELECT" ][] = get_object_vars( $object );
        return static::$Instance;
    }
    
    public function insert( $table )
    {
        $this -> field[ "INSERT INTO" ][] = $table;
        return static::$Instance;
    }
    
    public function update( $table )
    {
        $this -> field[ "UPDATE" ][] = $table;
        return static::$Instance;
    }
    
    public function delete( $table )
    {
        $this -> field[ "DELETE" ][] = $table;
        return static::$Instance;
    }
    
    //Возможна также передача объектов без массивов
    //надо реализовать это.
    public function addfield( $key, $value = "" )
    {
        $this -> field[ $key ][] = is_object( $value ) ? get_object_vars( $value ) : $value;
        return static::$Instance;
    }
    
    //Когда будут сделаны все вышеописанные функции
    //подредактировть эту функцию
    public function apply()
    {
        $fields = [];
        foreach ( $this -> field as $key => $field )
        {
            $fields[ $key ] = " " . $key . " ";
            foreach ( $field as $f )
            {
                switch ($key)
                {
                    case 'SELECT':
                        $fields[ $key ] .= implode( " , ", array_keys($f) );
                        break;
                    case 'INSERT INTO':
                        $fields[ $key ] .= implode( " , ", $f );
                        break;
                    case 'DELETE':
                        $fields[ $key ] .= implode( " , ", $f );
                        break;
                    case 'INTO':
                        $fields[ $key ] .= implode( " , ", $f );
                        break;
                    case 'VALUES':
                        $fields[ $key ] .= "(" . implode( " , ", array_values($f) ) . ")";
                        break;
                    case 'SET':
                        $fields[ $key ] .= implode( " AND ", $f );
                        break;
                    case 'FROM':
                        $fields[ $key ] .= implode( " , ", $f );
                        break;
                    case 'JOIN':
                        $fields[ $key ] .= implode( " ON ", $f );
                        break;
                    case 'WHERE':
                        $fields[ $key ] .= implode( " AND ", $f );
                        break;
                    case 'LIMIT':
                        $fields[ $key ] .= implode( " , ", $f );
                        break;
                    default:
                        $fields[ $key ] .= implode( " , ", $f );
                        break;
                }
            }
        }
        $this -> sql .= implode( " ", $fields );
        var_dump( $this -> sql );
        echo "<br />";
        return ( TRUE == $this -> sql );
    }
}