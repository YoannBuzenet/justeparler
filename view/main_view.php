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
	require('view/partials/navbar.php');
?>
  <a id="circle" class="btn-floating btn-large waves-effect waves-light red" href ="#form_bottom"><i class="material-icons">mode_edit</i></a>
	
<?php
	if(isset($_SESSION['user_first_connected']) && $_SESSION['user_first_connected'] == 'did_connect' && !isset($_SESSION['alert_please_retry'])) {
		echo '<div class="login_ok"> Vous êtes connecté ! </div>';
		$_SESSION['user_first_connected'] = 'forget_this';
	}
	elseif(isset($_SESSION['user_first_connected']) && $_SESSION['user_first_connected'] == 'did_connect' && isset($_SESSION['alert_please_retry'])) {
		echo '<div class="login_ok"> Vous êtes connecté ! Votre message a bien été posté. </div>';
		$_SESSION['user_first_connected'] = 'forget_this';
	}
	elseif(isset($_SESSION['user_first_connected']) && $_SESSION['user_first_connected'] == 'did_try_to_connect_but_could_not' && !isset($_SESSION['alert_please_retry'])) {
		echo '<div class="login_pas_ok"> Le login ou le mot de passe est incorrect. Merci de réessayer. <br> <a href=index.php?section=login_> Se connecter</a></div>' ;
			}
	elseif(isset($_SESSION['user_first_connected']) && $_SESSION['user_first_connected'] == 'did_try_to_connect_but_could_not' && $_SESSION['alert_please_retry'] == "go_retry"){
				echo '<div class="login_pas_ok"> Le login ou le mot de passe est incorrect. Merci de réessayer. (Votre message est toujours sauvegardé.) <br> <a href=index.php?section=login_> Se connecter</a></div>';
			}
	elseif(isset($_SESSION['user_first_registered']) && $_SESSION['user_first_registered'] == 'first_connection' && isset($_SESSION['posting_story']) && $_SESSION['posting_story'] == true) {
		echo '<div class="login_ok"> Vous êtes bien enregistré. Votre message a été posté.</div>';
	}	
	elseif(isset($_SESSION['user_first_registered']) && $_SESSION['user_first_registered'] == 'first_connection' && isset($_SESSION['posting_comment']) && $_SESSION['posting_comment'] == true) {
		echo '<div class="login_ok"> Vous êtes bien enregistré. Votre commentaire a été posté.</div>';
	}	
		$_SESSION['user_first_connected'] = 'forget_this';
		$_SESSION['user_first_registered']= 'forget_this';

	require('controllers/all_stories.php');	

?>
<script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>