<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ICommand;

/**
 *
 * @author Максим
 */
interface Command 
{
    public function Open();
    public function Close();
    public function Save();
    public function Create( $array );
    public function Current();    
}
