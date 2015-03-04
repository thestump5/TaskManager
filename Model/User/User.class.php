<?php

namespace User;
use Project\Project;
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
    
    public $attribute = [];
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
            ++$oiteratr;
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
    
    public function Project( array $pid )
    {
        $Project = Project :: Instance();
        $Project -> Open( $pid );
        return $Project;
    }    
    
    public function AcceptProjectPid( \Project\Project $pid )
    {
        $count = count( $this -> pidproject );
        $ncount = array_push( $this -> pidproject, get_object_vars($pid) );
        return ( ( $count + 1 ) == $ncount );
    }

    public function DisclaimeProjectPid( \Project\Project $pid )
    {
        $count = count( $this -> pidproject );
        if ( ( $key = array_search( get_object_vars( $pid ), $this -> pidproject ) ) )
        {
            unset( $this -> pidproject[ $key ] );
        }
        return ( ( $count - 1 ) == ( count( $this -> pidproject ) ) );
    }
//    public function SetAttribute( array $attribute )
//    {
//        $count = count( $this -> attribute );
//        $ncount = array_push( $this -> attribute, $attribute );
//        return ( ( $count + 1 ) == $ncount );
//    }
}
