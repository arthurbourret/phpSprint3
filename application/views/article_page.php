<div class="container">

	<div class='item meta'>
		<p>Auteur : <?php echo $auteur; ?> </p>
		<p><?php echo $date_Publi; ?></p>
	</div>
	<div class='item thematique'>Thématique : <?php echo $theme; ?></div>
	<div class='item article content'><?php echo $text; ?></div>
	<div class='item article title'><?php echo $titre; ?></div>

	<?php

	$url_controller = BASE_URL . INDEX . '/Accueil/';

	if (isset($_SESSION['login'])) {
		if ($_SESSION['login'] == $auteur) {
			echo "<form method='post' action=' " . $url_controller . "deleteArticle/" . $ref_Article . "'>
            	<input type='submit' name='delete' value=\"Supprimer l'article\"/>
 			</form>";

			if ($etat_Publi == 'brouillon') {
				echo "<form method='post' action=' " . $url_controller . "publierArticle/" . $ref_Article . "'>
           		    <input type='submit' name='publish' value=\"Publier l'article\"/>
     	         </form>";

				echo "<form method=\"post\" action=' " . $url_controller . "archiverArticle/" . $ref_Article . "'>
                <input type=\"submit\" name=\"archive\"
                 value=\"Archiver l'article\"/>
              </form>";
			}
		}
	}

	?>


</div>
