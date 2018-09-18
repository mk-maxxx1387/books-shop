<?php

class Controller_Genre
{
    private $model;

    public function __construct(){
        $this->model = new Model_Genre();
    }
    
    public function getGenre($id=null){
        $result = '';
        if($id){
            $result = $this->model->getGenreById($id);
        } else {
            $result = $this->model->getAllGenres();
        }
        
        if($result){
            return array("code" => 200, "data" => $result);
        } else {
            return array("code" => 400, "data" => "Empty result");
        }
    }
    public function postGenre(){}
    public function putGenre(){}
    public function deleteGenre(){}    
}
