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
    
    public function select(){}
    
    public function insert(){}
    
    public function update(){}
    
    public function delete(){}
    
    public function addfield( $key, $value )
    {
        if ( ( $this -> field[ $key ][] = $value ) != NULL )
        {
            return true;
        }
    }
}