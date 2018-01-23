<!DOCTYPE html>
<html>

	<head>
		<link rel="stylesheet" type="text/css" href="css/theme.css" />
		<title> Parler - Se connecter </title>
		<meta charset="utf-8" />
				<!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
		<meta name="viewport" content="width=device-width" />
	</head>

<body>
	<?php
if(isset($_SESSION['posting_story']) && $_SESSION['posting_story'] == true || isset($_SESSION['posting_comment']) && $_SESSION['posting_comment'] == true) {	
	echo '<div class="main_must_connect"> <div class="green_message">Votre message a été sauvegardé. Il n\'est pas encore publié.' ;
	echo '<br /> Pour publier votre message, merci de vous inscrire ou de vous connecter sur le site. Cela prends 2 secondes.</div>';
}

include('view/partials/register_or_login.php');

if(isset($_SESSION['posting_story']) && $_SESSION['posting_story'] == true || isset($_SESSION['posting_comment']) && $_SESSION['posting_comment'] == true) {	
$_SESSION['must_connect_or_log'] = 'now_ok';
$_SESSION['alert_please_retry'] = "go_retry";
}
?>

</body>
</html>