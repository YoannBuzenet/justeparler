<!DOCTYPE html>

<html>

	<head>
		<link rel="stylesheet" type="text/css" href="css/theme.css" />
		<title> Juste parler</title>
		<meta charset="utf-8" />
		<!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
		<meta name="viewport" content="width=device-width" />
	</head>

<body>
<?php
if(isset($_SESSION['did_try_to_register_but_couldnt']) && $_SESSION['did_try_to_register_but_couldnt'] == 'nickname_failed') {
	echo '<div class="register">Votre pseudo est déjà pris. Merci d\'en choisir un autre ! </div> <br />';
	}
elseif(isset($_SESSION['did_try_to_register_but_couldnt']) && $_SESSION['did_try_to_register_but_couldnt'] == 'mail_failed') {	
	echo '<div class="register">Votre adresse email est déjà prise. Merci d\'en choisir une autre ! </div> <br />';
	}

?>	

	<div class="register">
	<form class="register_form" method="POST" action="index.php?section=register_">
		<label> Votre login <input type="text" name="pseudo" required> </label> <br />
		<label> Votre mail ! <input type="text" name="mail" required> </label> <br />
		<label>Votre mot de passe <input type="password" name="password" required> </label> <br />
		<input type="submit" value=" Valider">
	</form>	
</div>

</body>
</html>	