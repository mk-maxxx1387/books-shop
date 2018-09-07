<html>
	<head>
		<title><?=$title?></title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
		<!--<script src="/js/main.js" type="text/javascript"></script>-->
	</head>
	<body class='admin-body'>
		<h1>BOOKS CATALOG ADMIN</h1>
		<a href="/">Exit from admin mode</a><br/>
		<a href="admin-mode/book/all">Books</a><br/>
		<a href="admin-mode/author/all">Authors</a><br/>
		<a href="admin-mode/genre/all">Genres</a><br/>
		<h2><?=$title?></h2>
		<? include $content; ?>
	</body>
</html>