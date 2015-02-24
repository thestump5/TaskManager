<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User;
use Repositoriy\Repositoriy;
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
    
//    public function Current()
//    {
//        return $this -> id;
//    }    

    public function FakeOpen( $variable )
    {
        $this -> id = (int)rand(0, 1000);
        return ($this -> id == TRUE);
    }
    
    
    public function Account()
    {
        $this -> Account = new Account( $this );
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
