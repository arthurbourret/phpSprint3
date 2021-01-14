<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Compte extends CI_Controller
{

	public function index()
	{
		$data['titre'] = "Création compte"; // nom de la page

		$this->load->helper('url'); // base url

		$this->load->view('header', $data); // menu
		$this->load->view('creation_compte_page'); // accueil
		$this->load->view('footer'); // bas de page
	}

	public function validcompte()
	{
		$error = false;
		$login = $this->input->post('login');
		$pass = $this->input->post('password');
		$verif = $this->input->post('verification');

		if ($pass === $verif) {
			$this->load->model('utilisateur');

			if ($this->utilisateur->createUser($login, $pass)) {
				// creation compte reussi
				session_start();
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
