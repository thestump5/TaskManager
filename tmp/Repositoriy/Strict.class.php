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
        return FALSE;
    }
    
    public function Grant()
    {
        return FALSE;
    }
}
