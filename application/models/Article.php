<?php


class Article extends CI_Model
{
	private $ref = null;

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * Trouve dans la bd, les articles publier
	 *
	 * @return mixed Retourne une liste des articles publier
	 */
	public function getArticlesAccueil($theme)
	{
		if ($theme == 'all') { // si tout theme selectionner
			$query = $this->db->query("SELECT * FROM Article WHERE etat_Publi = 'publier'");
		} else { // si theme particulier

			$theme = filter_var($theme, FILTER_SANITIZE_STRING); // securisation variable
			$query = $this->db->query("SELECT * FROM Article WHERE etat_Publi = 'publier' AND theme = ?", array($theme));
		}

		return $query->result_array();
	}

	public function getArticle($ref)
	{
		$sql = 'SELECT * FROM Article WHERE ref_Article = ?';
		$query = $this->db->query($sql, array($ref));
		return $query->first_row('array');
	}

	public function deleteArticle($ref)
	{

	}

	public function setEtatArticle($etat, $ref)
	{
		echo $ref;
		$etat = filter_var($etat, FILTER_SANITIZE_STRING);
		$ref = filter_var($ref, FILTER_SANITIZE_STRING);
		echo $ref;

		$sql = 'UPDATE Article SET etat_Publi = ? WHERE ref_Article = ?';
		$this->db->query($sql, array($etat, $ref));
	}
}
