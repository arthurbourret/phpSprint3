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

	public function getMesArticles($theme, $etat, $log)
	{
		$theme = filter_var($theme, FILTER_SANITIZE_STRING);
		$etat = filter_var($etat, FILTER_SANITIZE_STRING);

		if ($etat == 'all' && $theme == 'all') { // si etat et theme = all
			$query = $this->db->query(
				"SELECT * FROM Article WHERE auteur = ?", array($log));
		}
		if ($etat == 'all' && !($theme == 'all')) { // si etat = all
			$query = $this->db->query(
				"SELECT * FROM Article WHERE auteur = ? AND theme = ? ", array($log, $theme));
		}
		if (!($etat == 'all') && $theme == 'all') { // si theme = all
			$query = $this->db->query(
				"SELECT * FROM Article WHERE auteur = ? AND etat_Publi = ? ", array($log, $etat));
		}
		if (!($etat == 'all') && !($theme == 'all')) {
			$query = $this->db->query(
				"SELECT * FROM Article WHERE auteur =? AND etat_Publi = ? AND theme = ? ", array($log, $etat, $theme));
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
		$ref = filter_var($ref, FILTER_SANITIZE_STRING);

		$sql = 'DELETE FROM Article WHERE ref_Article = ?';
		$this->db->query($sql, array($ref));
	}

	public function setEtatArticle($etat, $ref)
	{
		$etat = filter_var($etat, FILTER_SANITIZE_STRING);
		$ref = filter_var($ref, FILTER_SANITIZE_STRING);

		$sql = 'UPDATE Article SET etat_Publi = ? WHERE ref_Article = ?';
		$this->db->query($sql, array($etat, $ref));
	}

	public function addArticle($titre, $theme, $resume, $text, $auteur, $etat)
	{
		$titre = filter_var($titre, FILTER_SANITIZE_STRING);
		$theme = filter_var($theme, FILTER_SANITIZE_STRING);
		$resume = filter_var($resume, FILTER_SANITIZE_STRING);
		$text = filter_var($text, FILTER_SANITIZE_STRING);
		$auteur = filter_var($auteur, FILTER_SANITIZE_STRING);
		$etat = filter_var($etat, FILTER_SANITIZE_STRING);

		$sql = "INSERT INTO Article (`titre`, `theme`, `resume`, `text`, `auteur`, `etat_Publi`) VALUES (?, ?, ?, ?, ?, ?)";
		$this->db->query($sql, array($titre, $theme, $resume, $text, $auteur, $etat));
	}
}
