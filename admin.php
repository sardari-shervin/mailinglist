<?php
	define('login', 'roarr');
	ob_start();
	include('incl/function.php');
	include('incl/init.php');
	$errors = array();
	if($_POST){

			$mailAdress = trim(strip_tags($_POST['mailAdress']));
			$password = trim(strip_tags($_POST['password']));
	
			

			if($_POST['messagespam'] != ''){
				die ('Spammeur');
			}
			//Je rempli le tableau avec les erreurs
			if($mailAdress == ''){
				$errors['mailAdress'] = "Indiquez votre email";
				
			}else if(valid_email($mailAdress) == false ){
					$errors['mailAdress'] = 'Adress Mail invalide';
				}
			if($password == ''){
				$errors['password'] = "Indiquez votre mot de passe";	
			}
		if(empty($errors)){
			$sql = 'SELECT * FROM users WHERE mail = :mail';
			$preparedStatement = $connexion->prepare($sql);
			$preparedStatement->bindValue(':mail', $mailAdress);
			$preparedStatement->execute();
			$user = $preparedStatement->fetch();
			if(!empty($user) && $user['role'] == 'admin' && $user['mdp'] == 'password'){
				$_SESSION['logged_in'] = 'ok';
		    	$_SESSION['mailAdress'] = $mailAdress;
		    	$_SESSION['role'] = $user['role'];
		    } else {
		    	$errors['login'] = "Mauvaise combinaison, essaye à nouveau !";
		    }
			
		}
}
?>


<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MailingList</title>
        <link rel="stylesheet" href="css/main.css">
        <link rel="author" href="humans.txt">
    </head>
    <body>
	
	    <?php 
			if($_SESSION['logged_in'] == 'ok'){
				include 'dash.php';
			} else { 
				include "login_view.php";
			}
	 	?>  
    </body>
</html>


