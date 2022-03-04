<?php

// your path will be different 
require_once(__DIR__ . '/pdo_5_author_repo.php'); 

class authorController{

public static function author($id)
{
    // your path will be different 
    $h = require (__DIR__ . '/pubs_connect.php');

    $auRepo = new authorRepo($h);

    $author = $auRepo->find($id); 

    echo json_encode($author);  
}

public static function updateAuthor($au)
{
    // your path will be different 
    $h = require (__DIR__ . '/pubs_connect.php');

    $auRepo = new authorRepo($h);

    $author = $auRepo->update($au); 

    echo json_encode($author);  
}

public static function authors()
{
    // your path will be different 
    $h = require (__DIR__ . '/pubs_connect.php');

    $auRepo = new authorRepo($h);

    $authors = $auRepo->findAll(); 

    echo json_encode($authors);  
}

}; 



?> 