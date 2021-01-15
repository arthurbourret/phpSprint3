<?php


class Utilisateur extends CI_Model
{

	protected $login = null;

	/**
	 * Utilisateur constructor. charge la base de donnees
	 */
	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * Permet de valider un couple (login,pass) auprès d'une base de données.
	 *
	 * @param string $login le login à vérifier.
	 * @param string $password le mot de passe à vérifier.
	 *
	 * @return boolean selon que l'authentification est ok ou pas.
	 */
	public function getAuth($login, $password)
	{
		if (!is_null($login) && !is_null($password)) {
			// si les params ne sont pas vide

			$login = filter_var($login, FILTER_SANITIZE_STRING); // filtre login
			$password = filter_var($password, FILTER_SANITIZE_STRING); // filtre pass

			$sql = 'SELECT * FROM SITE_User WHERE login = ? AND pass = ?'; // requete
			$query = $this->db->query($sql, array($login, $password)); // lance la requete

			$row = $query->first_row('array'); // verifie 1er resultat
			if (!is_null($row['login'])) { // verifie que le resultat n'est pas nul
				$this->login = $login; // instancie login
				return true;
			} else {
				$this->login = null; // desinstancie login
				return false;
			}
		}
	}

	/**
	 * Permet d'insérer un nouvel utilisateur dans la base de données.
	 *
	 * @param string $login le login à insérer.
	 * @param string $password le mot de passe à insérer.
	 *
	 * @return boolean selon que l'insertion est ok ou pas.
	 */
	public function createUser($login, $password)
	{
		$login = filter_var($login, FILTER_SANITIZE_STRING); // filtre login
		$password = filter_var($password, FILTER_SANITIZE_STRING); // filtre pass

		// verifie si n y a pas deja un user
		if (!$this->getAuth($login, $password)) {
			$this->db->insert('SITE_User', array("login" => $login, "pass" => $password));
			// insertion des donnees

			return $this->getAuth($login, $password); // verifie ajout
		} else return false;
	}

}
