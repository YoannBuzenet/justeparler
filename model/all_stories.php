<?php

	// On fetch les X derniers posts
	$reponse = $bdd->query('SELECT *, DAY(timepost) AS jour, MONTH(timepost) AS mois, YEAR(timepost) AS annee FROM posts ORDER BY timepost DESC');