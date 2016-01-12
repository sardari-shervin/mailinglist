<?php
function valid_email($email){
	return filter_var($email, FILTER_VALIDATE_EMAIL);
};
function message_erreur($errors, $clef){
		if(count($_POST)>0 && $errors[$clef] != ''){
			return "<p class='erreur'>".$errors[$clef]."</p>";
		}
};