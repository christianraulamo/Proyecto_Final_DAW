<?php

/**
 * Final degree project
 * 
 * @author CHRISTIAN RAÚL AMO OLSSON
 * @version 1.0
 */

require_once "BaseController.php";
require_once "modelos/receta.php";

class apiController extends BaseController
{

    function infoGlobal()
    {
        $apiKey = $_GET["apiKey"];

        $item = Receta::findAll();
        $data = array();
        foreach ($item as $row) {
            $data[] = [
                "Id"                => $row->getIdRec(),
                "Nombre receta"     => $row->getNomRec(),
                "Tiempo"            => $row->getTiempo(),
                "Raciones"          => $row->getRaciones(),
                "Temporada"         => $row->getTemporada(),
                "Posicion"          => $row->getPosicion(),
                "Clase"             => $row->getClase(),
                "Tipo"              => $row->getTipo(),
                "Uso"               => $row->getUso(),
                "metodo"            => $row->getMetodo()
            ];
        }
        // return the content specifying that it is JSON
        header("Content-Type: application/json;");
        header("charset=utf-8");

        echo (json_encode($data));
    }
}