<?php

class Model_Genre{

	private $db;

	public function __construct()
	{
		$this->db = new DB();
	}

	public function getAllGenres()
	{
		$genres = array();
		$query = "SELECT `id`,`name` FROM `genres`";

		$result = $this->db->queryFetchAll($query, null);
        if ($result){
            foreach ($result as $res){
                $genre = new Genre($res['id'], $res['name']);
                $genres[] = $genre;
            }
        }

        return $genres;
	}

	public function getGenreById($id)
	{
		$query = "SELECT `id`,`name` FROM `genres` WHERE `id` = ?";

		$result = $this->db->queryFetch($query, array($id));

        if ($result)
        {
        	return new Genre($result['id'], $result['name']);
        }
	}

	public function getGenreByBookId($book_id)
	{
		$query = "SELECT `genres`.`id`,`genres`.`name` 
				FROM `genres`,`books_genres` 
				WHERE `genres`.`id` = `books_genres`.`genre_id`
				AND `books_genres`.`book_id` = ?";

        $result = $this->db->queryFetchAll($query, array($book_id));
        $genres = array();

        if ($result)
        {
        	foreach ($result as $res) {
        		$genres[] = new Genre($res['id'], $res['name']);
        	}
        	return $genres;
        }
	}

	public function addGenre(Genre $genre)
	{
        $sql = "INSERT INTO `genres` (`name`)
				VALUES (?)";
		$this->db->queryFetch($genre->name);
	}

	public function editGenre(Genre $genre)
	{
		$sql = "UPDATE `genres` 
				SET `name` = ?
				WHERE `id` = ?";
        $this->db->queryFetch(array($genre->name, $genre->id));
	}

	public function deleteGenre($genre_id)
	{
		$sql = "DELETE FROM `genres` 
				WHERE `id` = ?";
		$this->db->queryFetch(array($genre_id));
	}
}