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
			$theme = "all"; // theme de base
		else
			$theme = $_POST['theme']; // theme particulier
		$this->load->model('article'); // chargement du modele
		$bdd['request'] = $this->article->getArticlesAccueil($theme); // les articles avec un theme

		$this->load->helper('url'); // base url

		$this->load->view('header', $data); // menu
		$this->load->view('accueil_site', $bdd); // accueil
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

	/**
	 * Affiche un article particulier (quand on clique sur lire l'article)
	 */
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

	/**
	 * Supprime un article
	 *
	 * @param $ref_Article La reference de l'article a supprimer
	 */
	public function deleteArticle($ref_Article)
	{
		$this->load->model('article'); // charge model
		$this->article->deleteArticle($ref_Article); // appele la methode pour delete

		$this->load->helper('url'); // charge les url
		header('Location: ' . base_url()); // revient a la page
	}

	/**
	 * Change le statut de l'article sur publier
	 *
	 * @param $ref_Article La reference de l'article
	 */
	public function publierArticle($ref_Article)
	{
		$this->changeEtat('publier', $ref_Article);
	}

	/**
	 * Change le statut de l'article sur archiver
	 *
	 * @param $ref_Article La reference de l'article
	 */
	public function archiverArticle($ref_Article)
	{
		$this->changeEtat('archiver', $ref_Article);
	}

	/**
	 * Change l'etat d'un article
	 *
	 * @param $etat L'etat sur lequel changer
	 * @param $ref_Article La reference de l'article
	 */
	private function changeEtat($etat, $ref_Article)
	{
		$this->load->model('article'); // charge model
		$this->article->setEtatArticle($etat, $ref_Article); // appel la methode pour changer

		header('Location: ../articlepage?id_ref=' . $ref_Article); // revient a la page
	}

}
