	<?php

		// Chargement des commentaires
	$commentaires = $bdd->prepare('SELECT * FROM comments WHERE id_article = ?');
	$commentaires->execute(array($_GET['histoire']));

	