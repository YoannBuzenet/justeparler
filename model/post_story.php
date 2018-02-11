<?php 


if(isset($_SESSION['pseudo'])){ 
$req = $bdd->prepare('INSERT INTO posts (texte, auteur, titre_post, categorie, URL_Youtube, timepost) VALUES(?, ?, ?, ?, ?, NOW())');
$req->execute(array($_POST['msg'], $_SESSION['pseudo'], $_POST['titre_post'], $_POST['categorie'], $_POST['URL_Youtube']));
}
else{
$req2 = $bdd->prepare('INSERT INTO temporary_posts (temporary_text, temporary_author, temporary_title, temporary_category, id_session, temporary_URL_Youtube, date_temporary_post) VALUES(?, ?, ?, ?, ?, ?, NOW())');
$req2->execute(array($_POST['msg'], $_POST['pseudo'], $_POST['titre_post'], $_POST['categorie'], session_id(), $_POST['URL_Youtube']));
$_SESSION['must_connect_or_log'] = 'must_log';
$_SESSION['posting_story'] = true;
}

