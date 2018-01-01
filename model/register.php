<?php

include('model/dbconnect.php');

$req = $bdd->prepare('SELECT COUNT(*) AS nb_pseudo FROM membres WHERE pseudo = ?');
$req->execute(array($_POST['pseudo']));

$donnees = $req->fetch();

$req2 = $bdd->prepare('SELECT COUNT(*) AS nb_mail FROM membres WHERE mail = ?');
$req2->execute(array($_POST['mail']));

$donnees2 = $req2->fetch();

if($donnees['nb_pseudo'] > 0) {
	echo '<div class="register">Votre pseudo est déjà pris. Merci d\'en choisir un autre ! </div> <br />';
	require('view/register.php');
}
elseif ($donnees2['nb_mail'] > 0) {
	echo '<div class="register">Votre adresse email est déjà prise. Merci d\'en choisir une autre ! </div> <br />';
	require('view/register.php');
}
elseif ($donnees['nb_pseudo']  == 0 && $donnees2['nb_mail'] == 0 ) {
	$pseudo = $_POST['pseudo'];
		$password = $_POST['password'];
		$password_hash = sha1("Hyl".$password."Pv7");
		$mail = $_POST['mail'];

		$lets_register = $bdd->prepare('INSERT INTO membres (pseudo, password, mail, date_membre_inscription) VALUES(?, ?, ?, NOW())');
		$lets_register->execute(array($pseudo, $password_hash, $mail));

		$_SESSION['pseudo'] = $pseudo;
		$_SESSION['password'] = $password_hash;
		$_SESSION['mail'] = $mail;

		$req->closeCursor ();
		$req2->closeCursor ();

		//Ici, on écrit l'éventuel post en BDD
		// On va chercher en temporaire afin de remettre en normal
		$req3 = $bdd->prepare('SELECT temporary_text, temporary_author, temporary_title, temporary_category, id_session, date_temporary_post FROM temporary_posts WHERE id_session = ?');
		$req3->execute(array(session_id()));
		$donnees = $req3->fetch();

		// On écrit dans le normal, puis on supprimera dans le temporaire
		$req4 = $bdd->prepare('INSERT INTO posts (texte, titre_post, auteur, categorie, timepost) VALUES(?, ?, ?, ?, ?)');
		$req4->execute(array($donnees['temporary_text'], $donnees['temporary_title'],$donnees['temporary_author'], $donnees['temporary_category'], $donnees['date_temporary_post']));
		
		$req3->closeCursor ();
		$req4->closeCursor ();

		//Ici, on écrit l'éventuel commentaire en BDD

header ('location:/parler/index.php');
}

$req->closeCursor ();
$req2->closeCursor ();
