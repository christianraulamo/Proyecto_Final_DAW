<?php

	require_once "libs/Data.php" ;

	$con = $_GET["con"]??"login" ;
	$ope = $_GET["ope"]??"listar" ;

	$nom = "{$con}Controller" ;

	require_once "controladores/$nom.php" ;

	$controller = new $nom() ;

	$controller->$ope() ;