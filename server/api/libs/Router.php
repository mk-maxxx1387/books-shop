<?php

/**
* 
*/
class Router
{

	static function start()
	{
		$req = explode('/', $_SERVER['REQUEST_URI']);
		$method = $_SERVER['REQUEST_METHOD'];

		$start = array_search('api', $req);
		
		$class = $req[$start+1];
		$param = $req[$start+2];
		$func = strtolower($method).ucfirst($class);
		$controller = "Controller_".ucfirst($class);
		$params = explode('.', $param);
		$params[0] = explode('?', $params[0])[0];
		
		self::setMethod($controller, $func, $params[0], $params[1]);
	}

	protected static function setMethod($controller, $func, $param, $printType){
		$obj = null;
		if(class_exists($controller)){
			$obj = new $controller();	
		} 
		if(method_exists($obj, $func)){
			$res = $obj->$func($param);
			new View($res['code'], $res['data'], $printType);
		} else {
			new View(404, "Page not found");
		}
	}
}