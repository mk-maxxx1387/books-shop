<?php

class Book_Service{
    private $book_model;
    private $auth_model;
    private $genre_model;

    public function __construct($book_model){
        $this->book_model = $book_model;
        $this->auth_model = new Model_Author();
        $this->genre_model = new Model_Genre();
    }

    public function getAllBooks(){
        $books = $this->book_model->getAllBooks();
        $result = array();
        foreach ($books as $b){
            $authors = $this->auth_model->getAuthByBookId($b['id']);
            $genres = $this->genre_model->getGenreByBookId($b['id']);
            $book = new Book($b['id'], $b['name'], $b['descr'], $b['price'], $authors, $genres);
            $result[] = $book;
            
        }
        return $result;
    }

    public function getBookById($book_id){
        $book = $this->book_model->getBookById($book_id);
		$book->authors = $this->auth_model->getAuthByBookId($book_id);
        $book->genres = $this->genre_model->getGenreByBookId($book_id);
        return $book;
    }
}