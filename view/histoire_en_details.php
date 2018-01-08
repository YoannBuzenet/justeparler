	<?php 

	if(isset($_SESSION['must_connect_or_log']) && $_SESSION['must_connect_or_log'] =='must_log') {

		include('must_connect_or_log.php');

	}

	?>

	<!DOCTYPE html>

<html>

	<head>
		<link rel="stylesheet" type="text/css" href="theme.css" />
		<title> Parler</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width" />
	</head>

<body>

	<?php

	echo '<div class="histoire_en_details">'. htmlspecialchars($contenu_histoire['texte']). '<br /> <strong>' . htmlspecialchars($contenu_histoire['auteur']). '</strong> <br />'. htmlspecialchars($contenu_histoire['timepost']). '<br /><br />' ;	
	$contenu_article_en_detail->closeCursor();


	while ($voir_commentaires = $commentaires->fetch()) {
			echo '<div class="commentaires_histoire_en_detail">'. htmlspecialchars($voir_commentaires['content']). '<br /> <strong>' . htmlspecialchars($voir_commentaires['auteur']). '</strong> <br />'. htmlspecialchars($voir_commentaires['timecomment']). '<br /><br />' ;
	}

	$commentaires->closeCursor();
?>
	<div class="comment_form">
		<form method="POST" action="controllers/post_comment.php">
			<label> Pseudo <input type="text" name="auteur"'; <?php if(isset($_SESSION['pseudo'])){ echo 'value="'.$_SESSION['pseudo']. '"';} elseif(isset($_COOKIE['pseudo'])){ echo 'value ="'. $_COOKIE['pseudo'] .'"';} ?> required /> </label> <br />
			<label> Votre message : <textarea name="text_comment" placeholder="Votre commentaire..." required></textarea> </label> 
			<br /> 
			<input type="hidden" name="id_article" <?php echo 'value="'. $_GET['histoire'].'"'; ?> />
			<input type="submit" value ="Envoyer" />
		</form>

	<br /> <br /> <a href="index.php"> Retour à l'accueil </a>
