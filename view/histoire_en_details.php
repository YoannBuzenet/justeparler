	<!DOCTYPE html>

<html>

	<head>
		<link rel="stylesheet" type="text/css" href="css/theme.css" />
		<title> Juste parler <?php echo ': '.htmlspecialchars($contenu_histoire['titre_post']); ?></title>
		<meta charset="utf-8" />
				<!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
		<meta name="viewport" content="width=device-width" />
	</head>

<body>

		<?php 

	if(isset($_SESSION['must_connect_or_log']) && $_SESSION['must_connect_or_log'] =='must_log') {

		include('must_connect_or_log.php');

	}
	require('view/partials/navbar.php');	

	?>

	<?php 	if(isset($_SESSION['user_first_connected']) && $_SESSION['user_first_connected'] == 'did_connect' && !isset($_SESSION['alert_please_retry'])) {
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

		?>

	<?php

	echo '<div class="histoire_en_details"> <strong>'. htmlspecialchars($contenu_histoire['titre_post']). '</strong> <br /> <br /><div class="content_story">'.htmlspecialchars($contenu_histoire['texte']). '</div> <br /><strong>' . htmlspecialchars($contenu_histoire['auteur']). '</strong> <br /> </div>' ;	
	$contenu_article_en_detail->closeCursor();


	while ($voir_commentaires = $commentaires->fetch()) {
			echo '<div class="commentaires_histoire_en_detail">'. htmlspecialchars($voir_commentaires['content']). '<br /> <span class="author_name"> Par ' . htmlspecialchars($voir_commentaires['auteur']). '</span> <br />'. '</div>' ;
	}

	$commentaires->closeCursor();
?>
	<div class="comment_form">
		<form method="POST" action="./index.php?section=post_comment" class=>
			<label> Pseudo <input type="text" name="auteur"'; <?php if(isset($_SESSION['pseudo'])){ echo 'value="'.$_SESSION['pseudo']. '"';} elseif(isset($_COOKIE['pseudo'])){ echo 'value ="'. $_COOKIE['pseudo'] .'"';} ?> required /> </label> <br />
			 <div class="input-field">
          <textarea id="textarea2" class="materialize-textarea" name="text_comment" required></textarea>
          <label for="textarea2">Votre message</label>
      </div>
			<br /> 
			<input type="hidden" name="id_article" <?php echo 'value="'. $_GET['histoire'].'"'; ?> />
			<input class="waves-effect waves-light btn" type="submit" value ="Envoyer" />
				<br /> <br /> <a href="index.php"> Retour à l'accueil </a>
		</form>

<script type="text/javascript" src="js/materialize.min.js"></script>		
