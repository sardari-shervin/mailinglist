<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/main.css">
        <link rel="author" href="humans.txt">
    </head>
    <body>
        <form method="POST">
			<label for="mailAdress">E-mail</label> 
			<input id="mailAdress" name="mailAdress" type="text" value="" />
			<?php  echo message_erreur($errors, 'mailAdress'); ?>
			<label for="password">password</label> 
			<input id="password" name="password" type="text" value="" />
			<?php  echo message_erreur($errors, 'password'); ?> 
			<!-- Honeypot -->
			<label for="messagespam" class="display">Lolilol</label> 
			<input id="messagespam" class="display" name="messagespam" type="text" value=""/>
			<!-- Fin du honeypot -->

			
			<input  name="submit" class="submit_button" type=submit value="se connecter"/>
		</form>
       
    </body>
</html>
