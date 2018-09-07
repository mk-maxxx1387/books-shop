<?php

/**
* 
*/
class Genre implements JsonSerializable
{
	
	private $id;
	private $name;

	public function __construct($id, $name)
	{
		$this->id = $id;
		$this->name = $name;
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