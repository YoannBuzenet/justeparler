<?php

echo '<div class="login"> <strong> Votre message a été sauvegardé. </strong></div>' ;
echo '<br /> Pour publier votre message, merci de vous inscrire ou de vous connecter sur le site.';
echo '<h2> Se connecter </h2>';
include('login.php');
echo '<h2> S\'inscrire </h2>';
include('register.php');
$_SESSION['must_connect_or_log'] = 'now_ok';
$_SESSION['alert_please_retry'] = "go_retry";
?>