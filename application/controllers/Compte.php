<?php


class Compte extends CI_Controller
{

	public function index() {
		$data['titre'] = "Création compte"; // nom de la page

		$this->load->helper('url'); // base url

		$this->load->view('header', $data); // menu
		$this->load->view('creation_compte_page'); // accueil
	}

	public function validcompte($log = null, $pass = null, $verif = null) {
		echo 'en cour';
	}

}
