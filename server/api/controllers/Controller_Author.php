<?php

class Controller_Author
{
    private $model;

    public function __construct(){
        $this->model = new Model_Author();
    }

    public function getAuthor($id=null){
        $result = '';
        if($id){
            $result = $this->model->getAuthById($id);
        } else {
            $result = $this->model->getAllAuth();
        }
        return array("code" => 200, "data" => $result);
    }
    public function postAuthor(){}
    public function putAuthor(){}
    public function deleteAuthor(){}    
}
