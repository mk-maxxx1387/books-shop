<?php

class Model_Genre{

	private $db;

	public function __construct()
	{
		$this->db = new PDO(
			'mysql:host='.DB_HOST.';dbname='.DB_NAME,
	    	DB_USER,
	    	DB_PASS
	    );
	}

	public function getAllGenres()
	{
		$genres = array();
		$sql = "SELECT `id`,`name` FROM `genres`";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result)
        {
            foreach ($result as $res)
            {
                $genre = new Genre($res['id'], $res['name']);
                $genres[] = $genre;
            }
        }

        return $genres;
	}

	public function getGenreById($id)
	{
		$sql = "SELECT `id`,`name` FROM `genres` WHERE `id` = ?";

		$stmt = $this->db->prepare($sql);
        $stmt->execute(array($id));
        $result = $stmt->fetch();

        if ($result)
        {
        	return new Genre($result['id'], $result['name']);
        }
	}

	public function getGenreByBookId($book_id)
	{
		$sql = "SELECT `genres`.`id`,`genres`.`name` 
				FROM `genres`,`books_genres` 
				WHERE `genres`.`id` = `books_genres`.`genre_id`
				AND `books_genres`.`book_id` = ?";

		$stmt = $this->db->prepare($sql);
        $stmt->execute(array($book_id));
        $result = $stmt->fetchAll();
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
        $sql = "INSERT INTO `genres` (`id`,`name`)
                VALUES (?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array('', $genre->name));
	}

	public function editGenre(Genre $genre)
	{
		$sql = "UPDATE `genres` 
				SET `name` = ?
				WHERE `id` = ?";
		$stmt = $this->db->prepare($sql);
        $stmt->execute(array($genre->name, $genre->id));
	}

	public function deleteGenre($genre_id)
	{
		$sql = "DELETE FROM `genres` 
				WHERE `id` = ?";
		$stmt = $this->db->prepare($sql);
        $stmt->execute(array($genre_id));
	}
}