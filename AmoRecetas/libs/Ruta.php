<?php

/**
 * Final degree project
 * 
 * @author CHRISTIAN RAÚL AMO OLSSON
 * @version 1.0
 */

function route($url, $con, $ope, $params = [])
{
	$ruta = "$url?con=$con&ope=$ope";

	foreach ($params as $key => $value)
		$ruta .= "&$key=$value";

	header('location:' . $ruta);
}