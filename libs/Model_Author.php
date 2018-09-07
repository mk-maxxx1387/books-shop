<?php

class Model_Author{

	private $db;

	public function __construct()
	{
		$this->db = new PDO(
			'mysql:host='.DB_HOST.';dbname='.DB_NAME,
	    	DB_USER,
	    	DB_PASS
	    );
	}

	public function getAllAuth()
	{
		$authors = array();
		$sql = "SELECT `id`,`name` FROM `authors`";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result)
        {
            foreach ($result as $res)
            {
                $author = new Author($res['id'], $res['name']);
                $authors[] = $author;
            }
        }

        return $authors;
	}

	public function getAuthById($id)
	{
		$sql = "SELECT `id`,`name` FROM `authors` WHERE `id` = ?";

		$stmt = $this->db->prepare($sql);
        $stmt->execute(array($id));
        $result = $stmt->fetch();

        if ($result)
        {
        	return new Author($result['id'], $result['name']);
        }
	}

	public function getAuthByBookId($book_id)
	{
		$sql = "SELECT `authors`.`id`,`authors`.`name` 
				FROM `authors`,`books_authors` 
				WHERE `authors`.`id` = `books_authors`.`auth_id`
				AND `books_authors`.`book_id` = ?";

		$stmt = $this->db->prepare($sql);
        $stmt->execute(array($book_id));
        $result = $stmt->fetchAll();
        $authors = array();

        if ($result)
        {
        	foreach ($result as $res) {
        		$authors[] = new Author($res['id'], $res['name']);
        	}
        	return $authors;
        }
	}

	public function addAuthor(Author $author)
	{
        $sql = "INSERT INTO `authors` (`id`,`name`)
                VALUES (?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array('', $author->name));
	}

	public function editAuthor(Author $author)
	{
		$sql = "UPDATE `authors` 
				SET `name` = ?
				WHERE `id` = ?";
		$stmt = $this->db->prepare($sql);
        $stmt->execute(array($author->name, $author->id));
	}

	public function deleteAuthor($auth_id)
	{
		$sql = "DELETE FROM `authors` 
				WHERE `id` = ?";
		$stmt = $this->db->prepare($sql);
        $stmt->execute(array($auth_id));
	}
}