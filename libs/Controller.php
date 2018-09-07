<?php

/**
* 
*/
class Controller
{
	protected $m_book;
	protected $m_auth;
	protected $m_genre;
	
	function __construct()
	{
		$this->m_book = new Model_Book();
		$this->m_auth = new Model_Author();
		$this->m_genre = new Model_Genre();
	}

	public function book_all()
	{
		/*
		$filter_auth = intval($_POST['filter_auth']);
		$filter_genre = intval($_POST['filter_genre']);

		$books_arr = $this->m_book->getAllBooks($filter_auth, $filter_genre);
		$auth_list = $this->m_auth->getAllAuth();
		$genre_list = $this->m_genre->getAllGenres();
		$books = array();

		foreach ($books_arr as $b) {
			$authors = $this->m_auth->getAuthByBookId($b['id']);
			$genres = $this->m_genre->getGenreByBookId($b['id']);
			$book = new Book($b['id'], $b['name'], $b['descr'], $b['price'], $authors, $genres);
			$books[] = $book;
		}*/

		$title = 'Books';
		$content = 'templates/books_list.tpl.php';
		include 'main.php';

	}

	public function book_details($book_id)
	{
		$book = $this->get_book($book_id);	

		$title = 'Book details';
		$content = 'templates/book_details.tpl.php';
		include 'main.php';
	}

	public function book_order($book_id)
	{
		$book = $this->get_book($book_id);	

		$auth_str = "";
		$genres_str = "";
		foreach ($book->authors as $auth) {
			$auth_str .= $auth->name.'; ';
		}
		foreach ($book->genres as $genre) {
			$genres_str .= $genre->name.'; ';
		}
	    $subject = 'Book order';

	    //set body of message
	    $body = "Book name: " . $book->name . "\n" .
	    		"Book author(s): " . $auth_str . "\n" .
	    		"Book genres(s): " . $genres_str . "\n" .
	            "Quantity: " . $_REQUEST['order_books_count'] . "\n" .
	            "-----------------------\n" .
	            "Address: " . $_REQUEST['order_address'] . "\n" .
	            "Receiver: " . $_REQUEST['order_full_name'];
	    mail(ORDER_EMAIL, $subject, $body);
	    header( 'Location: /', true, 307 );
	}

	protected function get_book($book_id)
	{
		$book = $this->m_book->getBookById($book_id);
		$book->authors = $this->m_auth->getAuthByBookId($book_id);
		$book->genres = $this->m_genre->getGenreByBookId($book_id);

		return $book;
	}
}