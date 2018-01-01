<?php

require('../model/dbconnect.php');

//mettre une sous couche pour poster commentaire logué en vrai base, ou poster non logué en base_temp
//if(isset($_SESSION['']))
require('../model/post_comment.php');

// Set Cookie
if(isset($_POST['pseudo'])){
	setcookie("pseudo", $_POST['pseudo']) ;
}

header("Location:../index.php?histoire=".$_POST['id_article']);