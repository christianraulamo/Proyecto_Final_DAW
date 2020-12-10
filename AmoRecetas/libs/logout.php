<?php

/**
 * Final degree project
 * 
 * @author CHRISTIAN RAÚL AMO OLSSON
 * @version 1.0
 */

require_once "Sesion.php";

$ses = Sesion::getInstance();

$ses->close();
echo $this->twig->render("login.php.twig");