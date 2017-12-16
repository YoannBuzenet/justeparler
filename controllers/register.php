<?php

if(isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['mail'])) {

require('model/register.php');

}

else{
	include('view/register.php');
}