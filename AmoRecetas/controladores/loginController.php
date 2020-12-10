<?php

/**
 * Final degree project
 * 
 * @author CHRISTIAN RAÚL AMO OLSSON
 * @version 1.0
 */

require_once "BaseController.php";
require_once "libs/Ruta.php";
require_once "modelos/usuario.php";
require_once "modelos/receta.php";
require_once "libs/Sesion.php";

class LoginController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * redirect to the login
     *
     * @access public
     */

    public function listar()
    {
        echo $this->twig->render("login.php.twig");
    }

    /**
     * create a user
     *
     * @access public
     * @param string $Correo user email
     * @param string $NomUsu User name
     * @param string $ApeUsu user last name
     * @param string $Contraseña password
     * @param string $Contraseña2 verification password
     */

    public function anadir()
    {
        if (!isset($_GET["NomUsu"])) {
            echo $this->twig->render("registrar.php.twig");
        } else {

            // create and save user
            $Correo = $_GET["Correo"];
            $NomUsu = $_GET["NomUsu"];
            $ApeUsu = $_GET["ApeUsu"];
            $Contraseña = $_GET["Contraseña"];
            $Contraseña2 = $_GET["Contraseña2"];

            $usu = new Usuario();
            if ($Contraseña === $Contraseña2) {

                // create the user
                $usu->setCorreo($Correo);
                $usu->setNomUsu($NomUsu);
                $usu->setApeUsu($ApeUsu);
                $usu->setContraseña($Contraseña);

                // save the user
                $usu->save();

                // redirect to the index
                route('index.php', 'login', 'listar');
            } else {
                echo $this->twig->render("registrar.php.twig", ['Correo' => $Correo, 'NomUsu' => $NomUsu, 'ApeUsu' => $ApeUsu, 'Contraseña' => $Contraseña, 'Contraseña2' => $Contraseña2, 'error' => 1]);
            }
        }
    }

    /**
     * create a user
     *
     * @access public
     * @param string $email user email
     * @param string $pass password
     */

    public function entrar()
    {
        $ses = Sesion::getInstance();


        if (!empty($_GET)) :

            $email = $_GET["email"];
            $pass  = $_GET["pass"];


            $ok  = $ses->login($email, $pass);

            if ($ok) {
                if ($email == "prueba@gmail.com") {

                    $dat = Receta::findAll();

                    echo $this->twig->render("verRecetasAdmin.php.twig", ['dat' => $dat]);
                } else {
                    $dat = Receta::findAll();

                    echo $this->twig->render("verRecetas.php.twig", ['dat' => $dat]);
                }
            } else {
                echo $this->twig->render("login.php.twig", ["inicio" => 'false']);
            }

        endif;
    }
}