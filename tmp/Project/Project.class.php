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
    public $command = [];
    
    private $User;
    private $Task;
    
    public static $Instance;
    
    public function Instance()
    {
        if ( empty( self::$Instance ) )
        {
            self::$Instance = new Project();
        }
        
        return self::$Instance;
    }
 
    public function Open()
    {
        Repositoriy :: Instance() -> Open( $this );
        return TRUE;
    }
    
    public function Close()
    {
        Repositoriy :: Instance() -> Save( $this );
        self :: $Instance = NULL;
        unset( $this );
        
        return TRUE;
    }
    
    public function Create( $name )
    {
        $this -> name = $name;
        return TRUE;
    }
    
    public function Current()
    {
        return $this -> id;
    }

    public function AcceptToCommand( User $User )
    {
        try
        {
            //Может быть можно хранить только id?
            $this -> command[] = &$User;
        }
        catch (\Exception $e)
        {
            throw new \Exception("Will not accept User ({$User -> name}) to current Project ({$this -> name}) command");
        }
        
        return TRUE;
    }


}
