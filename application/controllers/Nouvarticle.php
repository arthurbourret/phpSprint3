<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nouvarticle extends CI_Controller
{

	/**
	 * Method qui charge l'index a la page indique dans view
	 *
	 * Est la methode appelee sur la page de creation d'un article
	 */
	public function index()
	{
		$data = $this->set_data(); // recup connexion

		$data['titre'] = "Nouvel Article"; // nom de la page

		$this->load->helper('url'); // base url

		$this->load->view('header', $data); // menu
		$this->load->view('nouv_article_page'); // accueil
		$this->load->view('footer'); // bas de page
	}

	/**
	 * @return mixed Retourne le login de l'utilisateur dans un array
	 */
	private function set_data()
	{
		session_start(); // session

		if (isset($_SESSION['login'])) // regarde s'il y a un login
			$data['log'] = $_SESSION['login']; // recupere le login
		else $data['log'] = null; // ne recupere pas le login

		return $data;
	}

	public function addNewArticle()
	{
		$titre = $this->input->post('titre');
		$theme = $this->input->post('theme');
		$resume = $this->input->post('resume');
		$text = $this->input->post('corps_arcticle');

		session_start();
		$auteur = $_SESSION['login'];
		$etat = $this->input->post('etat');

		if (!empty($titre) && !empty($theme) && !empty($resume) && !empty($text)) {
			// si article complet
			$this->load->model('article');
			$this->article->addArticle($titre, $theme, $resume, $text, $auteur, $etat);

			$this->load->helper('url');
			header('Location: ' . base_url()); // revient a la page
		} else {
			$this->load->helper('url');
			header('Location: ' . base_url() . index_page() . '/newarticle'); // revien a la creation d'article
		}
	}

}
