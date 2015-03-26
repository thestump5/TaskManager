<?php

namespace Project;
use User\User;
use Repositoriy\Repositoriy;
/**
 * Description of Project
 *
 * @author Максим
 */

class Project
{
    public $id;
    public $name;

    public $Task = [];
    
    private static $Instance;
    
    public function Instance()
    {
        if ( empty( self::$Instance ) )
        {
            self::$Instance = new Project();
        }
        
        return self::$Instance;
    }
 
    public function Open( $pid )
    {
        $this -> Fill( $pid );
        return ( FALSE == Repositoriy :: Instance() -> Open( $this ) );
    }

    public function Close( $pid )
    {
        $this -> Fill( $pid );
        return ( TRUE == Repositoriy :: Instance() -> Close( $this ) );
    }

    public function Save()
    {
//        return ( FALSE == Repositoriy :: Instance() -> Save( $this ) );
    }
    
    //Think about this
    public function Fill( array $array )//rename to Create
    {
        $oiteratr = 0;
        foreach ($this as $key => $value)
        {
            if ( array_key_exists( $key , $array ) )
            {
                $this -> $key = $array[ $key ];
                ++$oiteratr;
            }
            else
            {
                $this -> $key = NULL;
            }
        }
        
        return ( count( $array ) == $oiteratr ); // ?
    }  
    
    public function SetTask( $Task )
    {
        $count = count( $this -> Task );
        $ncount = array_push( $this -> Task, $Task );
        return ( ( $count + 1 ) == $ncount );
    }

    public function MoveTask( $Task )
    {
        $count = count( $this -> Task );
        if ( TRUE !== ( $key = array_search( $Task, $this -> Task ) ) )
        {
            unset( $this -> Task[ $key ] );
        }
        return ( ( $count - 1 ) == ( count( $this -> Task ) ) );
    }    
//    
//    public function Close()
//    {
//        Repositoriy :: Instance() -> Save( $this );
//        self :: $Instance = NULL;
//        unset( $this );
//        
//        return TRUE;
//    }
//    
//    public function Create( $name )
//    {
//        $this -> name = $name;
//        return TRUE;
//    }
//    
//    public function Current()
//    {
//        return $this -> id;
//    }
//
//    public function AcceptToCommand( User $User )
//    {
//        try
//        {
//            //Может быть можно хранить только id?
//            $this -> command[] = &$User;
//        }
//        catch (\Exception $e)
//        {
//            throw new \Exception("Will not accept User ({$User -> name}) to current Project ({$this -> name}) command");
//        }
//        
//        return TRUE;
//    }


}
