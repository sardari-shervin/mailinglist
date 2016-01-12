<?php
include_once('incl/functions.php');
include_once('incl/init.php');

$email = $_GET['email'];
$date = time();

$sql = 'SELECT * FROM users WHERE mail = :mail';
$preparedStatement = $connexion->prepare($sql);
$preparedStatement->bindValue(':mail', $email);
$preparedStatement->execute();
$user = $preparedStatement->fetch();

$inscrip_time = $user['time'];
// var_dump($user);
// echo $inscrip_time;

$interval = $date-$inscrip_time;
$limit= 4800;
if($interval <= $limit){
	$query = "UPDATE users SET valid='1' WHERE mail = :mail";
	$preparedStatement = $connexion->prepare($query);
	$preparedStatement->bindValue(':mail', $email);
	$preparedStatement->execute();
	$user = $preparedStatement->fetch();
}

// echo $interval->format('%R%a days');


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
		<?php 
			if($interval <= $limit){
				echo "<h1>Bravo tu as été enregisté! </h1>";	
			}else{
				"<h1>trop tard ! recommence ton inscription</h1>";
			}
		 ?>
    </body>
</html>