<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Connexion extends CI_Controller
{

	/**
	 * Method qui charge l'index a la page indique dans view
	 *
	 * Est la methode appelee sur la page de connexion
	 */
	public function index()
	{
		$this->load->helper('url'); // base url

		$data['titre'] = "Connexion"; // nom de la page

		$this->load->view('header', $data);
		$this->load->view('connexion_page');
	}

	public function applyconnexion()
	{
		$login = $_POST['login'];
		$pass = $_POST['password'];

		$this->load->model('utilisateur');

		if ($this->utilisateur->getAuth($login, $pass)) {
			// connexion reussie
			$_SESSION['login'] = $this->utilisateur->getLogin();

			header('Location: ../'); // go to accueil
		} else {
			// connexion echoue
			$this->index();

			// TODO rajoute message erreur de connexion
		}
	}

	public function deconnexion()
	{
		session_start ();
		if (isset($_SESSION['login'])){

			session_unset ();
			session_destroy ();

			header('Location: ../'); // go to accueil
		}
	}

}
