<?php

require('../model/dbconnect.php');

require('../model/post_comment.php');

// Set Cookie
if(isset($_POST['pseudo'])){
	setcookie("pseudo", $_POST['pseudo']) ;
}

header("Location:../index.php?histoire=".$_POST['id_article']);