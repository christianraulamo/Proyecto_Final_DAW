<?php

/**
 * Final degree project
 * 
 * @author CHRISTIAN RAÚL AMO OLSSON
 * @version 1.0
 */

	require_once "vendor/autoload.php" ;

	class BaseController
	{
		protected $twig ;

		public function __construct()
		{
			$loader = new \Twig\Loader\FilesystemLoader("./vistas") ;

			$this->twig   = new \Twig\Environment($loader) ;
		}
	}