<?php

class Book implements JsonSerializable{
	private $id;
	private $name;
	private $descr;
	private $price;
	private $authors;
	private $genres;

	function __construct($id, $name, $descr, $price, $authors, $genres)
	{
		$this->id = $id;
		$this->name = $name;
		$this->descr = $descr;
		$this->price = $price;
		$this->authors = $authors;
		$this->genres = $genres;
	}

	public function __get($name)
	{
		return $this->$name;
	}

	public function __set($name, $value)
	{
		$this->$name = $value;
	}

	public function jsonSerialize()
	{
		return get_object_vars($this);
	}
	
}

