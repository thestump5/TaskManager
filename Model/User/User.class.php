<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User;
use ICommand\Command;
use Repositoriy\Repositoriy;
/**
 * Description of User
 *
 * @author Максим
 */
class User implements Command
{
    public $id;
    public $name;
    public $family;
    public $address;
    
    public $atribute;
    
    protected $Task = [];
    protected $Project = [];
    protected $Account;
    
    public static $Instance;
    
    public function Instance()
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
        ;
    }    
    
    public function Save()
    {
        ;
    }    
    
    public function Create( $array )
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
        
        return ( $oiteratr == count( $array ) );
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
    
    
    public function Account()
    {
        $this -> Account = new Account( self :: Instance() );
        return $this -> Account;
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
