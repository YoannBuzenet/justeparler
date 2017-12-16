<?php 

require('../model/dbconnect.php');

// Si on poste une histoire
if(isset($_POST['msg'])) {

require('../model/post_story.php');

}


// Set Cookie
if(isset($_POST['pseudo'])){
	setcookie("pseudo", $_POST['pseudo']) ;
}

header("Location:../index.php");


?>