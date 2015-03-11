<?php

namespace Database;

/**
 * Description of QueryBuilder
 * @author Максим
 */
class QueryBuilder 
{
    public $sql = "SELECT * FROM auth";
    public $field = [];
    
    public function select(){}
    
    public function insert(){}
    
    public function update(){}
    
    public function delete(){}
    
    public function addfield( $key, $value )
    {
        $this -> field[ $key ][] = $value;
    }
    
    public function apply()
    {
        return ( TRUE == $this -> sql );
    }
}