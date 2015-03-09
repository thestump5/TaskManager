<?php

namespace Repositoriy;

/**
 * Description of TaskRepositoriy
 *
 * @author Максим
 */

class Strict 
{
    public $Role;
    public $attribute;

    public function Strict()
    {
        return TRUE;
    }
    
    public function Grant()
    {
        return TRUE;
    }
}
