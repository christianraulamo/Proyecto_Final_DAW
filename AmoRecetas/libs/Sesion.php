<?php

/**
 * Proyecto fin de grado
 * 
 * @author CHRISTIAN RAÚL AMO OLSSON
 * @version 1.0
 */

class Sesion
{

	private $time_expire = 30000;
	private static $instancia = null;

	private function __construct()
	{
	}

	private function __clone()
	{
	}

	/**
	 * Close the session
	 *
	 * @access private
	 */

	public function logout()
	{
		$_SESSION = [];
		session_destroy();
	}

	/**
	 * pick up the instance
	 *
	 * @static 
	 * @access public 
	 * @return instancia
	 */

	public static function getInstance()
	{
		session_start();

		// check if there is a session
		if (isset($_SESSION["_sesion"])) :
			// if it exists we deserialize the session and save in the instance
			self::$instancia = unserialize($_SESSION["_sesion"]);
		else :
			if (self::$instancia === null)
				// if it is empty, we create a new session
				self::$instancia = new Sesion();
		endif;

		// return the instance
		return self::$instancia;
	}

	/**
	 * start of session
	 *
	 * @access public 
	 * @return Bool
	 */

	public function login(): bool
	{
		$_SESSION["time"]    = time();
		$_SESSION["_sesion"] = serialize(self::$instancia);
		return true;
	}

	/**
	 * Check if the session time has expired
	 *
	 * @access public 
	 * @return Bool
	 */

	public function isExpired(): bool
	{
		return (time() - $_SESSION["time"] > $this->time_expire);
	}

	/**
	 * Check if you are logged in
	 *
	 * @access public 
	 * @return Bool
	 */

	public function isLogged(): bool
	{
		return !empty($_SESSION);
	}

	/**
	 * Check if there is an active session
	 *
	 * @access public 
	 * @return Bool
	 */

	public function checkActiveSession(): bool
	{
		if ($this->isLogged())
			if (!$this->isExpired()) return true;
		//
		return false;
	}
}