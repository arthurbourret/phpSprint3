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
		$this->load->model('data_request');

		if ($this->utilisateur->getAuth($login, $pass)) {
			$this->index();
		} else $this->connexion();

	}

}
