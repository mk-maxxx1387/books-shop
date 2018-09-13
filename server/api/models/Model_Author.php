<?php

//include_once "../libs/DB.php";

class Model_Author{

	private $db;

	public function __construct()
	{
		$this->db = new DB();
	}

	public function getAllAuth()
	{
		$authors = array();
		$query = "SELECT `id`,`name` FROM `authors`";

		$result = $this->db->query($query);

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
		$query = "SELECT `id`,`name` FROM `authors` WHERE `id` = ?";

		$result = $this->db->queryFetch($query, array($id));

        if ($result)
        {
        	return new Author($result['id'], $result['name']);
        }
	}

	public function getAuthByBookId($book_id)
	{
		$query = "SELECT `authors`.`id`,`authors`.`name` 
				FROM `authors`,`books_authors` 
				WHERE `authors`.`id` = `books_authors`.`auth_id`
				AND `books_authors`.`book_id` = ?";

		$result = $this->db->queryFetchAll($query, array($book_id));
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
        $query = "INSERT INTO `authors` (`name`)
				VALUES (?)";
				
        $this->db->queryFetch($query, array($author->name));
	}

	public function editAuthor(Author $author)
	{
		$query = "UPDATE `authors` 
				SET `name` = ?
				WHERE `id` = ?";

		$this->db->queryFetch($query, array($author->name, $author->id));
	}

	public function deleteAuthor($auth_id)
	{
		$query = "DELETE FROM `authors` 
				WHERE `id` = ?";

		$this->db->queryFetch($query, array($author->name, $author->id));		
	}
}