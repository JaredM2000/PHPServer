<?php

$routes = []; 

function route($action, $callback)
{
    global $routes; // include from global scope

    //$action = trim($action, '/'); // remove slashes 

    $routes[ $action ] = $callback; 
}

function dispatch($action)
{
    global $routes; // include from global scope

    //$action = trim($action, '/'); // remove slashes 

    $callback = $routes[ $action ];

    echo call_user_func( $callback ); // call the function 
}


?>