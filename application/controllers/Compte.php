<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Compte extends CI_Controller
{

	/**
	 * Method qui charge l'index a la page indique dans view
	 *
	 * Est la methode appelee a la creation d'un compte
	 */
	public function index()
	{
		$data['titre'] = "Création compte"; // nom de la page

		$this->load->helper('url'); // base url

		$this->load->view('header', $data); // menu
		$this->load->view('creation_compte_page'); // accueil
		$this->load->view('footer'); // bas de page
	}

	/**
	 * Valide la creation d'un compte ou non
	 */
	public function validcompte()
	{
		$error = false; // si non valider
		$login = $this->input->post('login'); // recupere le login
		$pass = $this->input->post('password'); // recupere le mot de passe
		$verif = $this->input->post('verification'); // recupere la verification du pass

		if ($pass === $verif) { // la verification doit etre la meme que le pass
			$this->load->model('utilisateur'); // charge model

			if ($this->utilisateur->createUser($login, $pass)) { // si comte creer
				// creation compte reussi
				session_start(); // session
				$_SESSION['login'] = $login; // connecte user

				header('Location: ../'); // retourne a l'accueil
			} else $error = true;
		} else $error = true;

		if ($error) {
			// revien sur page de creation de compte
			$this->index();

			// TODO mettre message d'erreur
		}
	}

}
