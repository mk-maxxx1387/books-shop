<?php

/**
* 
*/
class Router
{

	static function start()
	{
		
		$class_name = 'Controller';
		$obj_name = 'book';
		$action_name = 'all';
		$param = ''; 


		$req = explode('/', $_SERVER['REQUEST_URI']);
		
		$start = array_search('git-hlam-and-etc', $req);
		//request counter
		$cntr = $start+1;
		if (!empty($req[$cntr]))
		{
			if($req[$cntr] == 'api'){
				//include '/api/Controller_Api.php';
				$class_name = 'Controller_Api';
				$cntr++;
			} elseif ($req[$cntr] == 'admin-mode') {				
				$class_name = 'Controller_Admin';
				//var_dump('admin');
				$cntr++;
			}
			if (!empty($req[$cntr]))
			{
				$obj_name = $req[$cntr];
				$cntr++;
				if (!empty($req[$cntr]))
				{
					$action_name = $req[$cntr];
					$cntr++;

					if (!empty($req[$cntr]))
					{
						$param = $req[$cntr];
					}
				}
			}

			
		}

		$class = new $class_name;
		$funct = $obj_name.'_'.$action_name;
		//var_dump($funct);

		if(method_exists($class, $funct))
		{
			if (!empty($param)) {
				$class->$funct($param);
			} else {
				$class->$funct();
			}
		}
		else
		{
			//Router::ErrorPage404();
		}
		
	}

	function ErrorPage404()
	{
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }


}