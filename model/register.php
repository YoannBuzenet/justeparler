<?php

include('model/dbconnect.php');

$req = $bdd->query('SELECT pseudo, mail FROM membres');

while ($donnees = $req->fetch()) {
	if(isset($_POST['pseudo']) && isset($_POST['password']) && $_POST['pseudo'] == $donnees['pseudo']){
		echo '<div class="register">Votre pseudo est déjà pris. Merci d\'en choisir un autre ! </div>';
	}
	elseif(isset($_POST['pseudo']) && isset($_POST['password']) && $_POST['mail'] == $donnees['mail']){
		echo '<div class="register">Votre adresse email est déjà prise. Merci d\'en choisir une autre ! </div>';
	}
	else{
		$pseudo = $_POST['pseudo'];
		$password = $_POST['password'];
		$password_hash = sha1("Hyl".$password."Pv7");
		$mail = $_POST['mail'];

		$lets_register = $bdd->prepare('INSERT INTO membres (pseudo, password, mail, date_membre_inscription) VALUES(?, ?, ?, NOW())');
		$lets_register->execute(array($pseudo, $password_hash, $mail));

		$_SESSION['pseudo'] = $pseudo;
		$_SESSION['password'] = $password_hash;
		$_SESSION['mail'] = $mail;
	break;

	}
}

$req->closeCursor ();

header ('location:/parler/index.php');