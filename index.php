<?php 

//ini_set('display_errors',1);

//Connection BDD
require('model/dbconnect.php');

session_start();

// Affichage en détail d'une histoire

if(isset($_SESSION['must_connect_or_log']) && $_SESSION['must_connect_or_log'] =='must_log') {

	include('view/must_connect_or_log.php');

}

elseif(isset($_GET['histoire'])){

	include 'controllers/histoire_en_detail.php';

}

elseif(isset($_GET['section']) && $_GET['section']=="login"){

	include 'view/login.php';
}

elseif(isset($_GET['section']) && $_GET['section']=="post"){

	include 'controllers/post.php';
}

elseif(isset($_GET['section']) && $_GET['section']=="post_comment"){

	include 'controllers/post_comment.php';
}

elseif(isset($_GET['section']) && $_GET['section']=="login_"){

	include 'controllers/login.php';
}

elseif(isset($_GET['section']) && $_GET['section']=="register"){
	
	include 'view/register.php';
}

elseif(isset($_GET['section']) && $_GET['section']=="register_"){
	
	include 'controllers/register.php';
}

elseif(isset($_GET['section']) && $_GET['section']=="login_"){
	
	include 'controllers/login.php';
}
elseif(isset($_SESSION['did_try_to_register_but_couldnt']) && $_SESSION['did_try_to_register_but_couldnt'] == 'nickname_failed')

	include 'view/register.php';

elseif(isset($_SESSION['did_try_to_register_but_couldnt']) && $_SESSION['did_try_to_register_but_couldnt'] == 'mail_failed') {	
	include 'view/register.php';
	}	

// Affichage de toutes les histoires si on a pas de GET
else {

require('view/main_view.php');

}
?>
