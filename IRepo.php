
<?php

interface IRepository
{
    public function add($item);
    public function find($id); 
    public function findAll(); 
    public function update($item);
    public function remove($id);
}

?> 