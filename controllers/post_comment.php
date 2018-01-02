<?php

require('../model/dbconnect.php');


if(isset($_SESSION['pseudo'])){
	require('../model/post_comment.php');
}
elseif(!isset($_SESSION['pseudo'])){

	require('../model/post_temporary_comment.php');	
}

// Set Cookie
if(isset($_POST['pseudo'])){
	setcookie("pseudo", $_POST['pseudo']) ;
}

header("Location:../index.php?histoire=".$_POST['id_article']);