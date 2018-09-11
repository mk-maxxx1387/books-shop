<?php

class Controller_Book
{
    private $model;

    public function __construct(){
        $this->model = new Model_Book();
    }
    
    public function getBook($id){
        $result = '';
        if($id){
            $result = $this->model->getBookById($id);
        } else {
            $result = $this->model->getAllBooks();
        }
        echo $result;
    }
    
    public function postBook(){

    }
    public function putBook(){}
    public function deleteBook(){}    
}
