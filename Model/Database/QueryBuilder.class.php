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
    
    private $key_exclude = ["FIELD"];
    
    function __construct() 
    {
        static :: $Instance = $this;
    }
    
    public function addpart( $key, $value = "" )
    {
        $this -> field[ $key ][] = is_object( $value ) ? array_keys( get_object_vars( $value ) ) : ( array )$value;
        return static::$Instance;
    }
    
    //Когда будут сделаны все вышеописанные функции
    //подредактировть эту функцию
    public function apply()
    {
        $fields = [];
        foreach ( $this -> field as $key => $field )
        {
            $fields[ $key ] =  " " . $key . " ";

            foreach ( $field as $f )
            {
                $fields[ $key ] .= $this -> prepare($key, $f);
            }
        }
        
        $this -> sql .= implode( " ", $fields );
        $this -> sql = str_replace( $this -> key_exclude, "", $this -> sql );
        
        var_dump( $this -> sql );
        echo "<br />";
        return ( TRUE == strlen( $this -> sql ) );
    }
    
    //TODO: rename function:
    private function prepare( $key, array $array )
    {
        $query = "";
        switch ($key)
        {
            case 'FIELD':
                $query .= "(" . implode( " , ", $array ) . ")";
                break;
            case 'VALUES':
                $query .= "(";
                for($i = 0; $i<count($array); $i++)
                {
                    $query .= is_int( $array[$i] ) 
                                        ?  $array[$i]
                                        : is_null( $array[$i] ) 
                                            ? $array[$i]
                                            : "'" . $array[$i] . "'";
                    $query .= ( $i/(count($array) - 1 ) !== 1 ) ? "," : "";
                }
                $query .= ")";
                break;
            case 'SET':
                $query .= implode( " AND ", $array );
                break;
            case 'JOIN':
                $query .= implode( " ON ", $array );
                break;
            case 'WHERE':
                $query .= implode( " AND ", $array );
                break;
            default:
                $query .= implode( " , ", $array );
                break;
        }
        
        return $query;
    }
    
    //TODO: function key exclude
    
}