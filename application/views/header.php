<?php
defined('BASEPATH') or exit('No direct script access allowed');

define('BASE_URL', base_url()); // lien de la base de l'application
define('INDEX', index_page());
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title><?php echo $titre; ?></title>

	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/styleAccueil.css" type="text/css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/stylesheet.css" type="text/css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/styleConnexion.css" type="text/css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/styleNewArticle.css" type="text/css">
</head>

<body>

<header>

	<img class='logo' src="<?php echo BASE_URL; ?>img/icon.png" alt=icon'>
	<div class='menu'>
		<a href='<?php echo BASE_URL; ?>'>Accueil</a>

		<?php

		$url_pages = BASE_URL . INDEX . '/';

		if (!isset($_SESSION['login'])) { // pour se connecter
			echo "<a href='" . $url_pages . "connexion'>Connexion</a>
                  <a href='" . $url_pages . "crea-compte'>Créer un compte</a>";

		} else { // si connecter

			$log = $_SESSION['login'];

			echo "<a href='" . $url_pages . "newarticle'>Nouvel article</a>
                  <a href='" . $url_pages . "mesarticles'>Mes articles</a>
                  
                  <a class='connect'
                    <p>Utilisateur : $log</p>
                    <form action='' method=''>
                        <input class='deco_submit' type='submit' value='Déconnexion'>
                    </form>
                  </a>";

		}
		?>

	</div>
</header>
