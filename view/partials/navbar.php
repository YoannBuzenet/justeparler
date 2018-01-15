	<header>
		<nav>
		<div class="title_fbar"><a href="./index.php" id="url_navbar">Quelle est votre histoire ? </a></div>
		<?php 	if(isset($_SESSION['pseudo'])){
		echo '<div class="confirmation_inscription"> Salut '. $_SESSION['pseudo']. ' !</div>';
	}
	?>
		</nav>	
	</header>