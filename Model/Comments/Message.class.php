<?php

namespace Comments;

/**
 * Description of Message
 * @author Максим
 */
class Message 
{
    private $text;
    private $date;
    private $ansver;    
    
    protected $User;
    
    public function __set( $name, $value ) 
    {
        return isset( $this -> $name ) 
                ? $this -> $name = $value 
                : FALSE;
    }
    
    public function __get( $name ) 
    {
        return isset( $this -> $name ) 
                ? $this -> $name 
                : FALSE;
    }    
}
