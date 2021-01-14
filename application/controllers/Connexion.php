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
		$this->load->view('footer'); // bas de page
	}

	public function applyconnexion()
	{
		$login = $this->input->post('login');
		$pass = $this->input->post('password');

		$this->load->model('utilisateur');

		if ($this->utilisateur->getAuth($login, $pass)) {
			// connexion reussie
			session_start();
			$_SESSION['login'] = $login; // connecte user

			header('Location: ../'); // retourne a l'accueil
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
