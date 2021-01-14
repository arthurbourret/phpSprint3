<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nouvarticle extends CI_Controller
{

	public function index()
	{
		$data = $this->set_data(); // recup connexion

		$data['titre'] = "Nouvel Article"; // nom de la page

		$this->load->helper('url'); // base url

		$this->load->view('header', $data); // menu
		$this->load->view('nouv_article_page'); // accueil
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

	public function publier()
	{
		$this->addNewArticle('publier');
	}

	public function brouillon()
	{
		$this->addNewArticle('brouillon');
	}

	private function addNewArticle($etat)
	{
		echo $etat;
	}

}
