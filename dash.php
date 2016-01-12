<?php 
// empecher l'accès depuis cette url
	if(!defined('login')){
		die('No access for you!');
	}
 ?> 
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Untitled</title>
        <link rel="stylesheet" href="css/main.css">
        <link rel="author" href="humans.txt">
    </head>
    <body>
    <a href="logout.php">Logout</a>
        <h1>Bienvenue sur votre dashboard</h1>
		
    </body>
</html>
