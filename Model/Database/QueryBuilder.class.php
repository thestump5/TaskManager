<?php

namespace Database;

/**
 * Description of QueryBuilder
 * @author stump
 */
class QueryBuilder 
{
    public $sql;
    public $field = [];
    
    private static $Instance;
    
    private $key_exclude = ["FIELD"];
    
    function __construct() 
    {
    //    static :: $Instance = $this;
    }
    
    public function addpart( $key, $value = "" )
    {
        $this -> field[ $key ][] = is_object( $value ) 
                                    ? array_keys( get_object_vars( $value ) ) 
                                    : ( array )$value;
        return $this;
    }
    
    //Когда будут сделаны все вышеописанные функции
    //подредактировть эту функцию
    public function apply()
    {
        $fields = [];
        foreach ( $this -> field as $key => $field )
        {
            foreach ( $field as $_field )
            {
                $fields[ $key ] =  " " . $key . " ";
                $fields[ $key ] .= $this -> prepare( $key, $_field );
            }
        }
        
        $this -> sql .= implode( " ", $fields );
        $this -> sql = str_replace( $this -> key_exclude, "", $this -> sql );
        
        var_dump( $this -> sql );
        echo "<br />";
        return ( TRUE == $this -> sql );
    }
    
    //TODO: rename function:
    private function prepare( $key, array $array )
    {
        $query = "";
        switch ($key)
        {
            case 'FIELD':
            case 'VALUES':
                $query .= "(" . implode( " , ", $array ) . ")";
                break;
            case 'JOIN':
            case 'INNER JOIN':
            case 'LEFT JOIN':
            case 'RIGHT JOIN':
            case 'CROSS JOIN':
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
}