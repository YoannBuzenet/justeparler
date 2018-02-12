<?php

$req = $bdd->prepare('INSERT INTO comments (id_article, auteur, content, timecomment) VALUES(?,?, ?, NOW())');
$req->execute(array($_POST['id_article'], $_SESSION['pseudo'],$_POST['text_comment']));
$req->closeCursor ();

//Envoi du mail à l'auteur du post

$req2 = $bdd->prepare('SELECT * FROM posts WHERE id = ?');
$req2->execute(array($_POST['id_article']));
$all_infos_comments = $req2->fetch();

$author_first_article = $all_infos_comments['auteur'];

$req3 = $bdd->prepare('SELECT * FROM membres WHERE pseudo = ?');
$req3->execute(array($author_first_article));
$all_infos_author = $req3->fetch();

$mail_author = $all_infos_author['mail'];

$to = $mail_author ;
$subject = 'Quelqu\'un a répondu à votre message !';
$message = 'Bonjour'. $author_first_article . ' ! Quelqu\'un a répondu à ton message. Clique sur ce lien pour répondre ! ';
$message = wordwrap($message,70);

mail($to, $subject, $message);

$req2->closeCursor();
$req3->closeCursor();