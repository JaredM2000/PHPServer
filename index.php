<?php

// https://www.youtube.com/watch?v=2_dqDpSSpsc

declare ( strict_types =1 );

require_once ('router.php'); // instead of composer 
require_once ('authorController.php');
//use App; 

$router = new router(); 

$router->get("/", function (){
    require_once 'authors.html';
}); 

$router->get('/about', function (){


    echo 'about page'; 

}); 

$router->get('/author', function ($id){

    authorController::author($id);
}); 

$router->get('/authors', function (){

    authorController::authors();
}); 

$router->addNotFoundHandler( function ()
{
    require_once '404.html'; 
}
); 


$router->run(); 


?>

