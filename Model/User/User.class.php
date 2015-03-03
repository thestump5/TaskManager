<?php

namespace User;

/**
 * Description of User
 *
 * @author Максим
 */
class User
{
    public $id;
    public $name;
    public $family;
    public $address;
    
    public $atribute;
    
    protected $Task = [];
    protected $Project = [];
    
    //private $Account;
    
    public static $Instance;
    
    public function &Instance()
    {
        if ( empty( self::$Instance ) )
        {
            self::$Instance = new User();
        }
        
        return self::$Instance;
    }

    /*===========================*/
    /*    ICommand interface     */
    /*===========================*/
    
    public function Open()
    {
        ;
    }

    public function Close()
    {
        foreach ( $this as $property )
        {
            unset( $property );
        }
        
        self :: $Instance = NULL;
        
        return TRUE;
    }    
    
    public function Save()
    {
        ;
    }    
    
    public function Create( array $array )
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
        
        return ( $oiteratr == count( $array ) ); // ?
    }
    
    public function Current()
    {
        return $this -> id;
    }    

    /*===========================*/
    /*  End ICommand interface   */
    /*===========================*/
    
    
    public function FakeOpen(  )
    {
        $this -> id = (int)rand(0, 1000);
        var_dump( $this -> id);
        echo __CLASS__ , " : " , __METHOD__;
        echo "<br />";
        return ( $this -> id == TRUE );
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
    
//    public function Create( $name, $family, $nic, $address )
//    {
//        $this -> name = $name;
//        $this -> family = $family;
//        $this -> nic = $nic;
//        $this -> address = $address;
//        
//        return TRUE;
//    }
    
//    public function Save()
//    {
//        Repositoriy :: Instance() -> Save ( $this );
//        return ($this -> id == TRUE);
//    }
}
