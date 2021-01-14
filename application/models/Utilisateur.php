<?php


class Utilisateur extends CI_Model
{

	protected $login = null;

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

			$login = filter_var($login, FILTER_SANITIZE_STRING);
			$pass = filter_var($password, FILTER_SANITIZE_STRING);

			$sql = 'SELECT * FROM SITE_User WHERE login = ? AND pass = ?';
			$query = $this->db->query($sql, array($login, $password));
			$result = $query->result_array();
			// requete et fetch sql

			$row = $query->first_row('array');
			if (!is_null($row['login'])) {
				$this->login = $login;
				return true;
			} else {
				$this->login = null;
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
		$login = filter_var($login, FILTER_SANITIZE_STRING);
		$password = filter_var($password, FILTER_SANITIZE_STRING);

		// verifie si n y a pas deja un user
		if (!$this->getAuth($login, $password)) {
			$this->db->insert('SITE_User', array("login" => $login, "pass" => $password));
			// insertion des donnees

			return $this->getAuth($login, $password); // verifie ajout
		} else return false;
	}

	/**
	 * Permet de modifier les données d'un utilisateur existant dans la base de données.
	 * (l'utilisateur mis à jour est celui préalablement connecté)
	 *
	 * @param string $password le mot de passe à mettre à jour.
	 *
	 * @return boolean selon que la mise à jour est ok ou pas.
	 */
	public function updateUser($password)
	{

		include_once('../config/DB.inc.php');

		$db = new PDO(
			"mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
			DB_USER,
			DB_PASS
		);

		$maj = "";
		$virgule = "";

		if (!is_null($password)) {
			$pass = filter_var($password, FILTER_SANITIZE_STRING);
			$maj .= $virgule . "pass='$pass'";
			$virgule = ", ";
		}

		$sql = "UPDATE SITE_User SET " . $maj . " WHERE login = '$this->login'";

		if ($db->exec($sql)) {
			return true;
		} else {
			return false;
		}
	}

}
