<?php
defined('BASEPATH') or exit('No direct script access allowed');

define('BASE_URL', base_url()) // lien de la base de l'application
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title><?php $titre ?></title>
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/styleAccueil.css" type="text/css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/stylesheet.css" type="text/css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/styleConnexion.css" type="text/css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/styleNewArticle.css" type="text/css">
</head>

<body>

<header>

	<img class='logo' src="<?php echo base_url(); ?>img/icon.png" alt=icon'>
	<div class='menu'>
		<a href='<?php base_url(); ?>'>Accueil</a>

		<?php

		$controller = BASE_URL . "application/controllers/";

		if (!isset($_SESSION['login'])) { // pour se connecter
			echo "<a href='" . $controller . "Accueil.php'>Connexion</a>
                  <a href='" . $controller . "Accueil.php'>Créer un compte</a>";

		} else { // si connecter

			$log = $_SESSION['login'];

			echo "<a href='" . $controller . "Accueil.php'>Nouvel article</a>
                  <a href='" . $controller . "Accueil.php'>Mes articles</a>
                  
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
