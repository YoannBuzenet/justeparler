<?php

if(isset($_POST['pseudo']) && isset($_POST['password'])) {

	require('model/login.php');

}


else{
	require('view/login.php');
}