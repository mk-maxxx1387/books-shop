<?php

class Controller_Book
{
    private $model;
    private $service;

    public function __construct(){
        $this->model = new Model_Book();
        $this->service = new Book_Service($this->model);
    }
    
    public function getBook($id=null){
        $result = '';
        if($id){
            $result = $this->service->getBookById($id);
        } else {
            $result = $this->service->getAllBooks();
        }
        return array("code" => 200, "data" => $result);
    }
    
    public function postBook(){

    }
    public function putBook(){}
    public function deleteBook(){}    
}
