<?php


class Article extends CI_Model
{

	/**
	 * Article constructor. charge la base de donnees
	 */
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

		return $query->result_array(); // retourne un tableau de resultat
	}

	/**
	 * Recupere les articles d'un utilisateur avec des etat et theme particulier
	 *
	 * @param $theme Le theme (all ou divers)
	 * @param $etat L'etat (all ou divers)
	 * @param $log Le login de l'utilisateur
	 * @return mixed Les articles correspondant
	 */
	public function getMesArticles($theme, $etat, $log)
	{
		$theme = filter_var($theme, FILTER_SANITIZE_STRING); // filtre le theme
		$etat = filter_var($etat, FILTER_SANITIZE_STRING); // filtre l'etat

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

		return $query->result_array(); // les resultats
	}

	/**
	 * Recupere un article en particulier
	 *
	 * @param $ref La reference de l'article
	 * @return mixed L'article
	 */
	public function getArticle($ref)
	{
		$sql = "SELECT * FROM Article WHERE ref_Article = ?"; // requete
		$query = $this->db->query($sql, array($ref)); // lance la requete
		return $query->first_row('array'); // recupere le 1er resultat
	}

	/**
	 * Supprime un article precis
	 *
	 * @param $ref La reference de l'article
	 */
	public function deleteArticle($ref)
	{
		$ref = filter_var($ref, FILTER_SANITIZE_STRING); // filtre la ref

		$sql = 'DELETE FROM Article WHERE ref_Article = ?'; // requete de suppresion
		$this->db->query($sql, array($ref)); // lance la requete
	}

	/**
	 * Change l'etat d'un article
	 *
	 * @param $etat L'etat sur lequel changer
	 * @param $ref La reference de l'article
	 */
	public function setEtatArticle($etat, $ref)
	{
		$etat = filter_var($etat, FILTER_SANITIZE_STRING); // filtre l'etat
		$ref = filter_var($ref, FILTER_SANITIZE_STRING); // filtre la ref

		$sql = 'UPDATE Article SET etat_Publi = ? WHERE ref_Article = ?'; // la requete
		$this->db->query($sql, array($etat, $ref)); // lance la requete
	}

	/**
	 * Ajoute un article
	 *
	 * @param $titre Le tritre
	 * @param $theme Le theme
	 * @param $resume Le resumer
	 * @param $text Le corps de l'article
	 * @param $auteur L'auteur
	 * @param $etat L'etat
	 */
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
