<?php

$req = $bdd->prepare('INSERT INTO comments (id_article, auteur, content, timecomment) VALUES(?,?, ?, NOW())');
$req->execute(array($_POST['id_article'], $_POST['auteur'],$_POST['text_comment']));
$req->closeCursor ();
