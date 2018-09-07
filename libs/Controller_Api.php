<?php

/**
* 
*/
class Controller_Api extends Controller
{
	function __construct() {
		parent::__construct();
	}

	
	public function book_all()
	{
		$filter_auth = intval($_POST['filter_auth']);
		$filter_genre = intval($_POST['filter_genre']);

		$books_arr = $this->m_book->getAllBooks($filter_auth, $filter_genre);
		$auth_list = $this->m_auth->getAllAuth();
		$genre_list = $this->m_genre->getAllGenres();

		$json_books = array();
		if (empty($books_arr)) {
			return;
		}

		foreach ($books_arr as $b) {
			$authors = $this->m_auth->getAuthByBookId($b['id']);
			$genres = $this->m_genre->getGenreByBookId($b['id']);
			$book = new Book($b['id'], $b['name'], $b['descr'], $b['price'], json_encode($authors), json_encode($genres));
			$json_books[] = $book->jsonSerialize();
		}

		
		$res = array('books' => $json_books, 'auth_list' => $auth_list, 'genre_list' => $genre_list);
		echo json_encode($res);
	}

	public function book_details($book_id)
	{
		$book = $this->get_book($book_id);	
		echo json_encode($book);
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
	    echo json_encode($book);
	}

		public function book_new()
	{

		$auth_list = $this->m_auth->getAllAuth();
		$genre_list = $this->m_genre->getAllGenres();

		$title = 'Add new book';
		$content = '/admin/templates/book_add.tpl.php';
		include '/admin/main.php';
	}
	/////////////////////
	public function book_add()
	{
		$book_id = $this->m_book->getNextBookId();
		$book = new Book(
			$book_id,
			$_POST['book_title'],
			$_POST['book_descr'],
			$_POST['book_price'],
			$_POST['book_authors'],
			$_POST['book_genres']
		);

		$this->m_book->addNewBook($book);
		$this->book_all();
	}

	public function book_edit($book_id)
	{
		$auth_list = $this->m_auth->getAllAuth();
		$genre_list = $this->m_genre->getAllGenres();
		$book = $this->get_book($book_id);
		echo "string";
		/*
		$book = $this->m_book->getBookById($book_id);
		$book->authors = $this->m_auth->getAuthByBookId($book_id);
		$book->genres = $this->m_genre->getGenreByBookId($book_id);

		$title = 'Edit book';
		$content = '/admin/templates/book_edit.tpl.php';
		include '/admin/main.php';
		*/
	}

	public function book_save($book_id)
	{
		$book = new Book(
			$book_id,
			$_POST['book_title'],
			$_POST['book_descr'],
			$_POST['book_price'],
			$_POST['book_authors'],
			$_POST['book_genres']
		);

		$this->m_book->editBook($book);
		$this->book_all();
	}

	public function book_delete()
	{
		$this->m_book->deleteBook($_REQUEST['book_id']);
		$this->book_all();
	}	

	

	public function author_add($author_id){
		$author = new Author(null, $_REQUEST['name']);
		$this->m_auth->addAuthor($author);
		$this->author_all();
	}

	public function author_edit($auth_id)
	{
		$author = $this->m_auth->getAuthById($auth_id);
		$title = 'Edit author';
		$content = '/admin/templates/auth_edit.tpl.php';
		include '/admin/main.php';
	}

	public function author_save($auth_id)
	{
		$author = new Author($auth_id, $_REQUEST['auth_name']);
		var_dump($author);
		$this->m_auth->editAuthor($author);
		$this->author_all();
	}

	public function author_delete($auth_id)
	{
		$this->m_auth->deleteAuthor($auth_id);
		$this->author_all();
	}

	public function author_all()
	{
		$authors = $this->m_auth->getAllAuth();
		echo json_encode($authors);
	}
	//////////////////////////////////////////////
	///////////////GENRE CONTROLLER///////////////
	public function genre_add(){
		$genre = new Genre(null, $_REQUEST['genre_name']);
		$this->m_genre->addGenre($genre);
		$this->genre_all();
	}

	public function genre_edit($genre_id)
	{
		$genre = $this->m_genre->getGenreById($genre_id);
		$title = 'Edit genre';
		$content = '/admin/templates/genre_edit.tpl.php';
		include '/admin/main.php';
	}

	public function genre_save($genre_id)
	{
		$genre = new Genre($genre_id, $_REQUEST['genre_name']);
		$this->m_genre->editGenre($genre);
		$this->genre_all();
	}

	public function genre_delete($genre_id)
	{
		$this->m_genre->deleteGenre($genre_id);
		$this->genre_all();
	}

	public function genre_all()
	{
		$genres = $this->m_genre->getAllGenres();
		$title = 'Genres';
		$content = '/admin/templates/genre_list.tpl.php';
		include '/admin/main.php';
	}
	///////////////////////////////////////////////



	////////DELETE///////

}