<?php


class Data_request extends CI_Model {

	/**
	 * Trouve dans la bd, les articles publier
	 *
	 * @return mixed Retourne une liste des articles publier
	 */
	function getArticlesAccueil($theme)
	{
		$this->load->database();

		if ($theme == 'all'){ // si tout theme selectionner
			$query = $this->db->query("SELECT * FROM Article WHERE etat_Publi = 'publier'");
		} else { // si theme particulier
			$query = $this->db->query("SELECT * FROM Article WHERE etat_Publi = 'publier' AND theme = '$theme'");
		}

		return $query->result_array();
	}

}
