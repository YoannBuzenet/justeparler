<?php 

include('model/dbconnect.php');

$pseudo = $_POST['pseudo'];
$password = $_POST['password'];
$password_hash = sha1("Hyl".$password."Pv7");

$req_login = $bdd->prepare('SELECT pseudo, password FROM membres WHERE pseudo = ? AND password = ?');
$req_login->execute(array($pseudo, $password_hash));
$_SESSION['user_first_connected'] = 'did_try_to_connect_but_could_not';

while ($donnees = $req_login->fetch()) {
	if(isset($password) && isset($pseudo) && $pseudo == $donnees['pseudo'] && $password_hash == $donnees['password']) {
		$_SESSION['user_first_connected'] = 'did_connect';
		$_SESSION['user_connected'] = true;
		$_SESSION['pseudo'] = $pseudo;
		$_SESSION['password'] = $password_hash;
		//Ici, on écrit l'éventuel post/comment temporaire en BDD
			if(isset($_SESSION['must_connect_or_log'] && $_SESSION['must_connect_or_log'])){
				if(isset($_SESSION['posting_story']) && $_SESSION['posting_story']){

				}
				elseif(isset($_SESSION['posting_comment']) && $_SESSION['posting_comment']) {
					
				}
			}
		break;
	}
}


$req_login->closeCursor ();

header ('location:/parler/index.php');