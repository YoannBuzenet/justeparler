<?php
session_start();

$_SESSION['must_connect_or_log'] = 'must_log';
$_SESSION['posting_comment'] = true;

$req = $bdd->prepare('INSERT INTO temporary_comments (id_article, temporary_auteur, temporary_content, id_session, temporary_time_comment) VALUES(?,?, ?, ?, NOW())');
$req->execute(array($_POST['id_article'], $_POST['auteur'],$_POST['text_comment'], session_id()));
$req->closeCursor ();
