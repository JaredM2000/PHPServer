<?php

include_once 'IRepo.php'; 

$h = require 'pubs_connect.php';

class authorRepo implements IRepository{

    private $handle;

    public function __construct($handle)
    {
        $this->handle = $handle;
    }

    //public function __destruct() {
       // $handle = null; 
   // }


    public function add($item){}

    public function find($id){

        $sql = 'SELECT * FROM authors WHERE au_id = :auid'; 

        
        $stmt = $this->handle->prepare($sql); 
        
        $stmt->bindParam(':auid', $id, PDO::PARAM_STR); 
        
        $stmt->execute(); 
        
        // FETCH_ASSOC = index by column name 
        $author = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]; // get array 
        
        return $author; 

    }

    public function findAll(){

        $sql = 'SELECT * FROM authors';

        $stmt = $this->handle->query($sql);

        $authors = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $authors;
    }
    public function update($item){}
    public function remove($id){}
}

?>