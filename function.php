<?php
function valid_email($email){
	return filter_var($email, FILTER_VALIDATE_EMAIL);
};
function message_erreur($errors, $clef){
		if(count($_POST)>0 && $errors[$clef] != ''){
			return "<p class='erreur'>".$errors[$clef]."</p>";
		}
};

function getConnectedUser($connexion){
		if(empty($_SESSION['user_secret'])){
		  	return false;
		}
		$secret = $_SESSION['user_secret'];
		$query = $connexion->prepare('SELECT * FROM user WHERE secret = :secret');
		$query->bindValue(':secret', $secret);
		$query->execute();
		if($user = $query->fetch()){
		  	return $user;
		}else{
		  return false;
		}
};