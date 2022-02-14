<?php

//require_once  'index.html' // this loads the index.html file 

require_once "router.php"; 

// register routes

route('/', function(){
    return "Hello world"; 
}); 

route('/about', function(){
    return "welcome to about"; 
}); 

route('/authors', function(){


    return "Welcome to the authors page";
});

$action = $_SERVER['REQUEST_URI'];


dispatch($action); 



?>