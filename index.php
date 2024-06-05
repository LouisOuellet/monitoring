<?php
// Initiate Session
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}

//Import phpRouter class into the global namespace
use LaswitchTech\phpRouter\phpRouter;

if(!is_file(__DIR__ . '/webroot/index.php')){

    //Load Composer's autoloader
    require __DIR__ . "/vendor/autoload.php";

    //Initiate phpRouter
    $phpRouter = new phpRouter();
}

require __DIR__ . '/webroot/index.php';
