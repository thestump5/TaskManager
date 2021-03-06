<?php

namespace User;
use Project\Project;
/**
 * Description of User
 * @author Максим
 */

class User
{
    private $id = -1;
    public $name;
    public $family;
    public $address;
    
    private $attribute = [];
    private $pidproject = [];
    
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

    public function __set( $name, $value )
    {
        $this -> $name = $value;
    }
    
    public function __get( $name )
    {
        return $this -> $name;
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
        
        $Account -> setUser( self :: Instance() );
        
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
        $ncount = array_push( $this -> pidproject, $pid );
        return ( ( $count + 1 ) == $ncount );
    }

    public function DisclaimeProjectPid( \Project\Project $pid )
    {
        $count = count( $this -> pidproject );
        $key = array_search( $pid, $this -> pidproject );
        if ( isset( $key ) )
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
