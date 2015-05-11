<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace Main;

error_reporting(E_ALL);
ini_set("deisplay_errors", 1);

$time_start = microtime( true );

require_once '/../Model/app.php';

session_start();


app::Init();
app :: Instance() -> Notify( "<b>Script time:</b> " . round( ( microtime( true ) - $time_start ), 5 ) );

$memmory = function( $size )
{
    $unit=array('b','kb','mb','gb','tb','pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
};

app :: Instance() -> Notify( "<b>Memory usage:</b> " . $memmory( memory_get_usage() ) );