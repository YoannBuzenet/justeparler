<?php

	$contenu_article_en_detail = $bdd->prepare('SELECT * FROM posts WHERE id = ?');
	$contenu_article_en_detail->execute(array($_GET['histoire']));
	$contenu_histoire = $contenu_article_en_detail->fetch();