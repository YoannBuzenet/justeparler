	<!DOCTYPE html>

<html>

	<head>
		<link rel="stylesheet" type="text/css" href="css/theme.css" />
		<title> Parler <?php echo ': '.htmlspecialchars($contenu_histoire['titre_post']); ?></title>
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

	?>

	<?php

	echo '<div class="histoire_en_details"> <strong>'. htmlspecialchars($contenu_histoire['titre_post']). '</strong> <br /> <br /><div class="content_story">'.htmlspecialchars($contenu_histoire['texte']). '</div> <br /><strong>' . htmlspecialchars($contenu_histoire['auteur']). '</strong> <br />'. htmlspecialchars($contenu_histoire['timepost']). '</div> <br /><br />' ;	
	$contenu_article_en_detail->closeCursor();


	while ($voir_commentaires = $commentaires->fetch()) {
			echo '<div class="commentaires_histoire_en_detail">'. htmlspecialchars($voir_commentaires['content']). '<br /> <strong>' . htmlspecialchars($voir_commentaires['auteur']). '</strong> <br />'. htmlspecialchars($voir_commentaires['timecomment']). '<br /><br />' ;
	}

	$commentaires->closeCursor();
?>
	<div class="comment_form">
		<form method="POST" action="./index.php?section=post_comment" class=>
			<label> Pseudo <input type="text" name="auteur"'; <?php if(isset($_SESSION['pseudo'])){ echo 'value="'.$_SESSION['pseudo']. '"';} elseif(isset($_COOKIE['pseudo'])){ echo 'value ="'. $_COOKIE['pseudo'] .'"';} ?> required /> </label> <br />
			<label> Votre message : <textarea name="text_comment" placeholder="Votre commentaire..." required></textarea> </label> 
			<br /> 
			<input type="hidden" name="id_article" <?php echo 'value="'. $_GET['histoire'].'"'; ?> />
			<input type="submit" value ="Envoyer" />
				<br /> <br /> <a href="index.php"> Retour à l'accueil </a>
		</form>
