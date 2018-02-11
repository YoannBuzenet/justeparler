	<header>
		<nav>
		<div class="title_fbar"><a href="./index.php" id="url_navbar">Quelle est votre histoire ? </a></div>
		<?php 	if(isset($_SESSION['pseudo'])){
					echo '<div class="confirmation_inscription"> Salut '. $_SESSION['pseudo']. ' !</div>';
				}	
				elseif(!isset($_SESSION['pseudo'])){
					echo '<a href="index.php?section=register_or_log"><div class="se_connecter">Se Connecter / S\'inscrire </div> <img src="pictures/Login-Logo_mini.png" alt="Login picture" class="pic_login" /></a>';
				}
	
	?>
		</nav>	
	</header>