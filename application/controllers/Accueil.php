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
		$data = $this->set_data(); // recup connexion

		$data['titre'] = "Blog groupe 3"; // nom de la page

		if (!isset($_POST['theme'])) // le theme des articles a charger
			$theme = "all";
		else
			$theme = $_POST['theme'];
		$bdd['request'] = $this->article->getArticlesAccueil($theme); // les articles avec un theme

		$this->load->helper('url'); // base url

		$this->load->view('header', $data); // menu
		$this->load->view('accueil_site', $bdd); // accueil
		$this->load->view('footer'); // bas de page
	}

	public function set_data()
	{
		session_start(); // session
		$this->load->model('article'); // la database

		if (isset($_SESSION['login']))
			$data['log'] = $_SESSION['login'];
		else $data['log'] = null;

		return $data;
	}

	public function articlepage()
	{
		$ref_article = $this->input->get('id_ref'); // recupere id de l'article

		$this->load->model('article'); // charge model
		$article = $this->article->getArticle($ref_article); // charge donnees de l'article

		$data = $this->set_data(); // recup connexion

		$data['titre'] = $article['titre']; // nom de la page

		$this->load->helper('url'); // base url

		$this->load->view('header', $data); // menu
		$this->load->view('article_page', $article); // accueil
		$this->load->view('footer'); // bas de page
	}

	public function deleteArticle($ref_Article)
	{
		$this->load->model('article'); // charge model
		$this->article->deleteArticle($ref_Article);
	}

	public function publierArticle($ref_Article)
	{
		$this->changeEtat('publier', $ref_Article);
	}

	public function archiverArticle($ref_Article)
	{
		$this->changeEtat('archiver', $ref_Article);
	}

	private function changeEtat($etat, $ref_Article)
	{
		$this->load->model('article'); // charge model
		$this->article->setEtatArticle($etat, $ref_Article);

		header('Location: ../articlepage?id_ref=' . $ref_Article); // revient a la page
	}

}
