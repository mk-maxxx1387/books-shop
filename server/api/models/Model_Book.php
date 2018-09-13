<?php

//include_once "../libs/DB.php";

class Model_Book{

	private $db;

	public function __construct()
	{
		$this->db = new DB();
	}

	public function getAllBooks($auth_id=null, $genre_id=null)
	{
		$data = array();
		$books = array();
		$query = "SELECT `books`.`id`,`books`.`name`, `books`.`descr`, `books`.`price` 
				FROM `books`";
		$query_where = "WHERE 1 ";
		
		if (!empty($auth_id)) {
			$query .= ", `books_authors` as `b_a`";
			$query_where .= " AND `books`.`id` = `b_a`.`book_id`";
			$query_where .= " AND `b_a`.`auth_id` = ?";//.$auth_id;
			$data.push($auth_id);
		}
		if (!empty($genre_id)) {
		 	$query .= ", `books_genres` as `b_g`";
		 	$query_where .= " AND `books`.`id` = `b_g`.`book_id`";
			$query_where .= " AND `b_g`.`genre_id` = ?";//.$genre_id;
			$data.push($genre_id);
		 } 
		$query .= $query_where;

		$result = $this->db->queryFetchAll($query, $data);
        if ($result)
        {
			return $result;
		}
	}

	public function getBookById($id)
	{
		$query = "SELECT `id`,`name`, `descr`, `price` 
				FROM `books`
				WHERE `id`=?";

		$res = $this->db->queryFetchAll($query, array($id));
		$res = $res[0];

        if ($res) {
			return new Book($res['id'], $res['name'], $res['descr'], $res['price'], '', '');
        }
	}

	public function addNewBook()
	{
		$book = new Book(
			null,
			$_POST['book_title'],
			$_POST['book_descr'],
			$_POST['book_price'],
			$_POST['book_authors'] ,
			$_POST['book_genres']
		);

		$sql = "INSERT INTO `books` (`name`, `price`, `descr`)
				VALUES (?,?,?)";

        $this->addBookRelations($book->id, $book->authors, $book->genres);
	}

	public function editBook(Book $book)
	{
		$book = new Book(
			$book_id,
			$_POST['book_title'],
			$_POST['book_descr'],
			$_POST['book_price'],
			$_POST['book_authors'],
			$_POST['book_genres']
		);

		$sql = "UPDATE `books`
				SET `name` = ?, `descr` = ?, `price` = ?
				WHERE `id` = ?";

		$this->db->queryFetch(
			$query, 
			array($book->name, $book->descr, $book->price, $book->id)
		);

        $this->deleteBookRelations($book->id);
        $this->addBookRelations($book->id, $book->authors, $book->genres);
	}

	public function deleteBook($book_id)
	{
		$query = "DELETE FROM `books` 
				WHERE `id` = ?";
		$this->db->queryFetch($query, array($book_id));
        $this->deleteBookRelations($book_id);
	}
	
	private function addBookRelations($book_id, $authors, $genres)
	{
		$data = array(); 
		$query = "INSERT INTO `books_authors` (`book_id`, `auth_id`)";
		for ($i=0; $i < count($authors); $i++) {
			$query .= "VALUES (?,?)";
			$data.push($book_id);
			$data.push($authors[$i]);
		}
		$result = $this->db->queryFetch($query, $data);

		$data = array(); 
		$query = "INSERT INTO `books_genres` (`book_id`, `genre_id`)";
		for ($i=0; $i < count($genres); $i++) {
			$query .= "VALUES (?,?)";
			$data.push($book_id);
			$data.push($genres[$i]);
		}
		$result = $this->db->queryFetch($query, $data);
	}

	private function deleteBookRelations($book_id)
	{
		$sql = "DELETE FROM `books_authors` 
				WHERE `book_id` = ?";
		$this->db->queryFetch(array($book_id));

        $sql = "DELETE FROM `books_genres` 
				WHERE `book_id` = ?";
		$this->db->queryFetch(array($book_id));
	}
}