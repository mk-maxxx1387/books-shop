<?php

class Model_Book{

	private $db;

	public function __construct()
	{
		$this->db = new PDO(
			'mysql:host='.DB_HOST.';dbname='.DB_NAME,
	    	DB_USER,
	    	DB_PASS
	    );
	}

	private function addBookRelations($book_id, $authors, $genres)
	{
		for ($i=0; $i < count($authors); $i++) { 
			$sql = "INSERT INTO `books_authors` (`id`, `book_id`, `auth_id`)
				VALUES (?,?,?)";
			$stmt = $this->db->prepare($sql);
        	$stmt->execute(array('', $book_id, $authors[$i]));
		}
		for ($i=0; $i < count($genres); $i++) { 
			$sql = "INSERT INTO `books_genres` (`id`, `book_id`, `genre_id`)
				VALUES (?,?,?)";
			$stmt = $this->db->prepare($sql);
        	$stmt->execute(array('', $book_id, $genres[$i]));
		}
	}

	private function deleteBookRelations($book_id)
	{
		$sql = "DELETE FROM `books_authors` 
				WHERE `book_id` = ?";
		$stmt = $this->db->prepare($sql);
        $stmt->execute(array($book_id));

        $sql = "DELETE FROM `books_genres` 
				WHERE `book_id` = ?";
		$stmt = $this->db->prepare($sql);
        $stmt->execute(array($book_id));
	}

	public function getAllBooks($auth_id, $genre_id)
	{
		$data = array();
		$books = array();
		$sql = "SELECT `books`.`id`,`books`.`name`, `books`.`descr`, `books`.`price` 
				FROM `books`";
		$sql_where = "WHERE 1 ";
		
		if (!empty($auth_id)) {
			$sql .= ", `books_authors` as `b_a`";
			$sql_where .= " AND `books`.`id` = `b_a`.`book_id`";
			$sql_where .= " AND `b_a`.`auth_id` = ".$auth_id;
		}
		if (!empty($genre_id)) {
		 	$sql .= ", `books_genres` as `b_g`";
		 	$sql_where .= " AND `books`.`id` = `b_g`.`book_id`";
			$sql_where .= " AND `b_g`.`genre_id` = ".$genre_id;
		 } 
		$sql .= $sql_where;

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result)
        {
            return $result;
        }
	}

	public function getBookById($id)
	{
		$sql = "SELECT `id`,`name`, `descr`, `price` 
				FROM `books`
				WHERE `id`=?";

		$stmt = $this->db->prepare($sql);
        $stmt->execute(array($id));
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($res) {
        	return new Book($res['id'], $res['name'], $res['descr'], $res['price'], '', '');
        }
	}

	public function getNextBookId()
	{
		$sql = "SHOW TABLE STATUS FROM ".DB_NAME." LIKE 'books'";
		$stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return intval($res['Auto_increment']);
	}

	public function addNewBook(Book $book)
	{
		$sql = "INSERT INTO `books` (`id`, `name`, `price`, `descr`)
				VALUES (?,?,?,?)";

		$stmt = $this->db->prepare($sql);
        $stmt->execute(array('', $book->name, $book->price, $book->descr));

        $this->addBookRelations($book->id, $book->authors, $book->genres);
	}

	public function editBook(Book $book)
	{
		$sql = "UPDATE `books`
				SET `name` = ?, `descr` = ?, `price` = ?
				WHERE `id` = ?";

		$stmt = $this->db->prepare($sql);
        $stmt->execute(array($book->name, $book->descr, $book->price, $book->id));

        $this->deleteBookRelations($book->id);
        $this->addBookRelations($book->id, $book->authors, $book->genres);
	}

	public function deleteBook($book_id)
	{
		$sql = "DELETE FROM `books` 
				WHERE `id` = ?";
		$stmt = $this->db->prepare($sql);
        $stmt->execute(array($book_id));
        $this->deleteBookRelations($book_id);
	}
	
	public function getBooksByAuthor($auth_id)
	{
		# code...
	}
	public function getBooksByGenre($genre_id)
	{
		# code...
	}
}