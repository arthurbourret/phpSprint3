<form method="post" action="<?php echo BASE_URL . INDEX; ?>/applyconnexion">

	<div class="connexion">
		<p class="titreCo">CONNEXION</p>

		<input class="saisie log" type="text" placeholder="Login" name="login">
		<input class="saisie pass" type="password" placeholder="Mot de passe" name="password">

		<input type="submit" class="bouton" value="Connexion"/>
		<br/>
		<a href="<?php echo BASE_URL . INDEX; ?>/creacompte" class="creercompe">Créer un compte</a>
	</div>

</form>
