<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mesarticles extends CI_Controller
{

	/**
	 * Method qui charge l'index a la page indique dans view
	 *
	 * Est la methode appelee sur la page des articles de l'utilisateur
	 */
	public function index()
	{
		$data = $this->set_data(); // recup connexion

		$data['titre'] = "Mes articles"; // nom de la page

		if (!isset($_POST['theme'])) // le theme des articles a charger
			$theme = "all";
		else $theme = $this->input->post('theme');
		if (!isset($_POST['etat']))
			$etat = "all";
		else $etat = $this->input->post('etat');
		$bdd['request'] = $this->article->getMesArticles($theme, $etat, $data['log']); // les articles avec un theme

		$this->load->helper('url'); // base url

		$this->load->view('header', $data); // menu
		$this->load->view('mesarticles_page', $bdd); // accueil
		$this->load->view('footer'); // bas de page
	}

	private function set_data()
	{
		session_start(); // session
		$this->load->model('article'); // la database

		if (isset($_SESSION['login']))
			$data['log'] = $_SESSION['login'];
		else $data['log'] = null;

		return $data;
	}

}
