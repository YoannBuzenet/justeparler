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
		//Ici, on écrit l'éventuel post/comment temporaire en BDD si le mec arrive à a se log
				if(isset($_SESSION['posting_story']) && $_SESSION['posting_story']){
					// On va chercher en temporaire afin de remettre en normal
						$req = $bdd->prepare('SELECT temporary_text, temporary_author, temporary_title, temporary_category, id_session, date_temporary_post FROM temporary_posts WHERE id_session = ?');
						$req->execute(array(session_id()));
						$donnees = $req->fetch();

					// On écrit dans le normal
						$req2 = $bdd->prepare('INSERT INTO posts (texte, titre_post, auteur, categorie, timepost) VALUES(?, ?, ?, ?, ?)');
						$req2->execute(array($donnees['temporary_text'], $donnees['temporary_title'],$pseudo, $donnees['temporary_category'], $donnees['date_temporary_post']));
						$req2->closeCursor ();

					// On supprime du temporaire
					$req3 = $bdd->prepare('DELETE FROM temporary_posts WHERE id_session = ?');
						$req3->execute(array(session_id()));
						$req3->closeCursor ();	
				}	
				elseif(isset($_SESSION['posting_comment']) && $_SESSION['posting_comment']) {
					// On va aller chercher le commentaire dans le temporaire
					$req5 = $bdd->prepare('SELECT id_article,temporary_auteur, temporary_content, temporary_time_comment FROM temporary_comments WHERE id_session = ?');
					$req5->execute(array(session_id()));
					$donnees = $req5->fetch();

					// On va poster le commentaire

					$req6 = $bdd->prepare('INSERT INTO comments (id_article, auteur, content, timecomment) VALUES(?, ?, ?, ?)');
					$req6->execute(array($donnees['id_article'], $pseudo, $donnees['temporary_content'], $donnees['temporary_time_comment']));
					$req6->closeCursor ();

					// On le supprime du temporaire
					$req7 = $bdd->prepare('DELETE FROM temporary_comments WHERE id_session = ?');
					$req7->execute(array(session_id()));
					$req7->closeCursor ();
				}	
		break;
	}
}


$req_login->closeCursor ();


header ('location:/parler/index.php');