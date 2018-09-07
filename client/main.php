<html>
	<head>
		<title><?=$title?></title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
		<script src="js/main.js" type="text/javascript"></script>
	</head>
	<body>
		
		<h1>BOOKS CATALOG</h1>
		<a href="admin-mode/">Admin mode</a>
		<h2><?=$title?></h2>
		<? include $content; ?>
	</body>
</html>