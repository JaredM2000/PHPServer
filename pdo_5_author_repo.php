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
    public function update($item){
        require_once 'model.php';

        $sql = 'UPDATE authors SET au_fname= :aufname, au_lname= :aulname, phone= :aunumber, address= :auaddress WHERE au_id= :auid';

        $stmt = $this->handle->prepare($sql);
        
        $stmt->bindParam(':auid', $item->id, PDO::PARAM_STR); 
        $stmt->bindParam(':aufname', $item->fname, PDO::PARAM_STR); 
        $stmt->bindParam(':aulname', $item->lname, PDO::PARAM_STR); 
        $stmt->bindParam(':aunumber', $item->number, PDO::PARAM_STR); 
        $stmt->bindParam(':auaddress', $item->address, PDO::PARAM_STR); 

        $stmt->execute(); 
    }
    public function remove($id){}
}

?>