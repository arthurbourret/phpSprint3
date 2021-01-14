<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accueil extends CI_Controller
{

	/**
	 * Method qui charge l'index a la page indique dans view
	 *
	 * Est la methode appelee au lancement de l'application
	 */
	public function index()
	{
		$data['titre'] = "Blog groupe 3"; // nom de la page

		$this->load->model('data_request'); // la database

		if (!isset($_POST['theme'])) // le theme des articles a charger
			$theme = "all";
		else
			$theme = $_POST['theme'];
		$bdd['request'] = $this->data_request->getArticlesAccueil($theme); // les articles avec un theme

		$this->load->helper('url'); // base url

		$this->load->view('header', $data); // menu
		$this->load->view('accueil_site', $bdd); // accueil
	}
}
