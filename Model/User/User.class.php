<?php

namespace User;

/**
 * Description of User
 * @author Максим
 */

class User
{
    public $id;
    public $name;
    public $family;
    public $address;
    
    public $atribute;
    public $pidproject = [];
    
    protected $Task = [];   
    
    public static $Instance;
    
    public static function Instance()  
    {
       if ( empty( self :: $Instance ))
       {
           self :: $Instance = new User();
       }
       
       return self :: $Instance;
    }    
    
    public function Fill( array $array )
    {
        $oiteratr = 0;
        foreach ($array as $key => $value)
        {
            if ( !property_exists( $this , $key ) )
            {
                continue;
            }
            
            $this -> $key = $value;
            $oiteratr++;
        }

        return ( $oiteratr == ( count( $array ) - 1 ) ); // ?
    } 

    public function Account( $Account = NULL )
    {
        if ( empty( $Account ) )
        {
            $Account = new Account();
        }
        
        $Account -> User = &self :: Instance();
        
        return $Account;
    }
    
    public function AcceptProjectPid( \Project\Project $pid )
    {
        $count = count( $this -> pidproject );
        $ncount = array_push( $this -> pidproject, get_object_vars($pid) );
        return ( ( $count + 1 ) == $ncount );
    }
}
