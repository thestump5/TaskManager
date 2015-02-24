<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace Main;

$time_start = microtime();

require_once '/../Model/app.php';

app::Init();
app :: Instance() -> Notify( "<b>Script time:</b> " . round((microtime() - $time_start), 5) );