<form method="post" action="<?php echo BASE_URL . INDEX; ?>/mesarticles">
	<select name="etat" size="1">
		<option value="all">Tout les articles
		<option value="brouillon">Brouillon
		<option value="publier">Publier
		<option value="archiver">Archiver
	</select>

	<select name="theme" size="1">
		<option value="all">Tout les thèmes
		<option value="sport">Sport
		<option value="cuisine">Cuisine
		<option value="cinema">Cinema
		<option value="informatique">Informatique
	</select>
	<input type="submit" value="Sélectionner">
</form>

<?php

foreach ($request as $row) {
	$ref = $row["ref_Article"];
	$titre = $row["titre"];
	$resume = $row["resume"];

	echo
	"<div class='container' >
        <div class='item thematique'>$titre</div>
        <div class='item article title'>$resume</div>
        <a href=\"PageArticle.php?id_ref=$ref\">Consulter l'article</a>
    </div>";
}

?>
