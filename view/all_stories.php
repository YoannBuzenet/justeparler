<section class ="sousbody">
	<section class="main_div">	
	<?php
	while ($donnees = $reponse->fetch()) {
		// Squelette du post
		echo '<article class="histoire">'.' <p class="titre_histoire"> <strong>'. htmlspecialchars($donnees['titre_post']) . '</strong></p> ';
		// Si besoin d'afficher la date, c'est ici
		//echo '<span class="timepost"> Le ' . htmlspecialchars($donnees['jour']). ' '. htmlspecialchars($donnees['mois']). ' '. htmlspecialchars($donnees['annee']). '</span>'; 
		// Intitulés des catégories
		if(htmlspecialchars($donnees['categorie']) == "bons_moments") {
			echo '<p class="au_dessus_de_categorie"> <span class="categorie"> Bons moments </span> </p>';
		}
		elseif (htmlspecialchars($donnees['categorie']) == "histoire_du_jour") {
			echo '<p class="au_dessus_de_categorie"> <span class="categorie"> Histoire du jour </span> </p>';
		}
		elseif (htmlspecialchars($donnees['categorie']) == "travail") {
			echo '<p class="au_dessus_de_categorie"> <span class="categorie"> Travail </span> </p>';
		}
		elseif (htmlspecialchars($donnees['categorie']) == "couple") {
			echo '<p class="au_dessus_de_categorie"> <span class="categorie"> Couple </span> </p>';
		}
		elseif (htmlspecialchars($donnees['categorie']) == "celibataires") {
			echo '<p class="au_dessus_de_categorie"> <span class="categorie"> Célibataires </span> </p>';
		}
		elseif (htmlspecialchars($donnees['categorie']) == "souvenirs") {
			echo '<p class="au_dessus_de_categorie"> <span class="categorie"> Souvenirs </span> </p>';
		}
		echo ' <p class="main_text">'.htmlspecialchars($donnees['texte']).'</p>'; 

		echo '<span class="auteur"> Par <strong>' .htmlspecialchars($donnees['auteur']).'</strong> </span> ' ;

		$recup_commentaires = $bdd->prepare('SELECT COUNT(*) AS nbcomments FROM comments WHERE id_article = ?');
		$recup_commentaires->execute(array($donnees['id']));
		$resultat_compte_commentaires = $recup_commentaires->fetch();

		// Affichage du nombre de commentaires, ou de "Commenter" s'il n'y en a pas.
		if($resultat_compte_commentaires['nbcomments'] == 0)	{
			echo '<a class="comment" href="index.php?histoire='. $donnees['id'].'"><img src="pictures/Pictures_mini.jpg" alt="Image de Commentaire" class="pic_comments" />Commenter </a></article>' ;
		}
		else {
			echo '<a class="comment" href="index.php?histoire='. $donnees['id'].'">'.'<img src="pictures/Pictures_mini.jpg" class="pic_comments" alt="Image de Commentaire" />'. $resultat_compte_commentaires['nbcomments'];

				if($resultat_compte_commentaires['nbcomments'] == 1){
					echo ' commentaire</a> </article>';
				} 

				elseif($resultat_compte_commentaires['nbcomments']> 1){
					echo ' commentaires</a> </article>';
				}
	}
	}
	$reponse->closeCursor();

	?>
	</section>
	<aside>
		<div class="first_bubble">
		<p> Qu'avez-vous sur le coeur ? </p>
		<p> Travail, amour, solitude, journée de merde ? Peu importe ! Restez anonyme, et partagez un peu avec d'autres personnes... </p>
			<div class="main_form">
	<form method="POST" action='./index.php?section=post'>
	<label> Pseudo <input type="text" name="pseudo" <?php if(isset($_SESSION['pseudo'])){ echo 'value="'.$_SESSION['pseudo']. '"';} elseif(isset($_COOKIE['pseudo'])){ echo 'value ="'. $_COOKIE['pseudo'] .'"';} ?> required /> </label> <br />
	<label> Votre message : <textarea name="msg" required placeholder="Votre message..."> </textarea></label> <br />
	<label> Titre de votre message <input type="text" name="titre_post" required /> </label> <br />
	<label> Catégorie :   <select name="categorie" required>
		<option value="histoire_du_jour">Histoire du jour</option>
		<option value="travail">Travail</option>
		<option value="couple">Couple</option>
		<option value="celibataires">Célibataires</option>
	    <option value="bons_moments">Bons moments</option>
	    <option value="souvenirs">Souvenirs</option>
	  </select>
	  <br><br></label>
	<input type="submit" value="Poster"/>
	</form>
		</div>
	</div>
<!--		<div class="second_bubble">
			Les thèmes du moment
		</div>
-->		
	</aside>
</section>
