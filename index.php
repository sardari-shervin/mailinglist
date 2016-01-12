<?php
	ob_start();
	include('incl/function.php');
	include('incl/init.php');
	$errors = array();
	if($_POST){
		$mailAdress = trim(strip_tags($_POST['mailAdress']));
		//
		$link = 'http://shervinsardari.be/php/mailinglist/confirmation.php/?email='.$mailAdress;
			if($_POST['messagespam'] != ''){
				die ('Spammeur');
			}
			//Je rempli le tableau avec les erreurs
			if($mailAdress == ''){
				$errors['mailAdress'] = "Indiquez votre email";
				
			}else if(valid_email($mailAdress) == false ){
					$errors['mailAdress'] = 'Adress Mail invalide';
				}
			if(empty($errors)){
			
			$time = time();

			$sql = 'INSERT INTO users(mail, role, time, valid)
			VALUES(:mail, :role, :time, :valid)';

			// $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

			// $secret = uniqid();
			$preparedStatement = $connexion->prepare($sql);
			$preparedStatement->bindValue(':mail', $mailAdress);
			$preparedStatement->bindValue(':role', 'lecteur');
			$preparedStatement->bindValue(':time', $time);
			$preparedStatement->bindValue(':valid', '0');

			if($preparedStatement->execute()){
				require 'lib/PHPMailerAutoload.php';

				$mail = new PHPMailer;

				//$mail->SMTPDebug = 3;                               // Enable verbose debug output

				$mail->isSMTP();                                      // Set mailer to use SMTP
				$mail->Host = 'smtp.mandrillapp.com';  // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = 'alexandre@pixeline.be';                 // SMTP username
				$mail->Password = 'bDMUEuWn1H4r3FCGQjyO-g';                           // SMTP password
				$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 587;                                    // TCP port to connect to
				$mail->setFrom('test@example.com', 'Mailer');
				$mail->addAddress($mailAdress);     // Add a recipient
				$mail->isHTML(true);                // Set email format to HTML
				$mail->Subject = 'Lien de verification'; 
				$mail->Body    = "Voici votre lien de confirmation. <br />".$link;//variable utilisateur secret
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

				if(!$mail->send()) {
				    echo 'Message could not be sent.';
				    echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
				    header('Location: merci.php');
					exit;
				}
				
			}
		}
	}	
?><!doctype html>
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
    <a href="admin.php">Connexion à la base de donnée</a>
			<h1>Inscription à notre mailing List</h1>
	    <form method="POST">
	 		

			<label for="mailAdress">E-mail</label> 
			<input id="mailAdress" name="mailAdress" type="text" value="" />
			<?php  echo message_erreur($errors, 'mailAdress'); ?>
			<!-- Honeypot -->
			<label for="messagespam" class="display">Lolilol</label> 
			<input id="messagespam" class="display" name="messagespam" type="text" value=""/>
			<!-- Fin du honeypot -->

			
			<input name="submit" class="submit_button" type=submit value="S'inscrire"/>
		</form> 
    </body>
</html>


