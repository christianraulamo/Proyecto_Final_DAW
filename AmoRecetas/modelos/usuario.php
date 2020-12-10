<?php

require_once "libs/Database.php";

class Usuario
{
    private $IdUSu;
    private $Correo;
    private $NomUsu;
    private $Contraseña;
    private $Admin;

    public function __construct()
    {
    }

    /**
     * @return mixed $IdUSu
     */
    public function getIdUSu()
    {
        return $this->IdUSu;
    }

    /**
     * @return mixed $IdUSu
     */
    public function setIdUSu($IdUSu)
    {
        $this->IdUSu = $IdUSu;

        return $this;
    }
    /**
     * @return mixed $Correo
     */
    public function getCorreo()
    {
        return $this->Correo;
    }

    /**
     * @return mixed $Correo
     */
    public function setCorreo($Correo)
    {
        $this->Correo = $Correo;

        return $this;
    }

    /**
     * @return mixed $NomUsu
     */
    public function getNomUsu()
    {
        return $this->NomUsu;
    }

    /**
     * @return mixed $NomUsu
     */
    public function setNomUsu($NomUsu)
    {
        $this->NomUsu = $NomUsu;

        return $this;
    }
    
    /**
     * @return mixed $ApeUsu
     */
    public function getApeUsu()
    {
        return $this->ApeUsu;
    }

    /**
     * @return mixed $ApeUsu
     */
    public function setApeUsu($ApeUsu)
    {
        $this->ApeUsu = $ApeUsu;

        return $this;
    }

    /**
     * @return mixed $Contraseña
     */
    public function getContraseña()
    {
        return $this->Contraseña;
    }

    /**
     * @return mixed $Contraseña
     */
    public function setContraseña($Contraseña)
    {
        $this->Contraseña = $Contraseña;

        return $this;
    }

    /**
     * @return mixed $Admin
     */
    public function getAdmin()
    {
        return $this->Admin;
    }

    public function save()
    {
        $db  = new BaseDeDatos();

        if (is_null($this->IdUsu)) :

            $sql = "INSERT INTO usuario (Correo, NomUsu, ApeUsu, Contraseña) 
                                VALUES ('{$this->Correo}', '{$this->NomUsu}', '{$this->ApeUsu}', md5('{$this->Contraseña}')) ;";


            $db->query($sql);

            $this->idUsu = $db->lastId();
        else :

            // actualizamos el usuario
            $db->query("UPDATE usuario SET NomUsu='{$this->NomUsu}', ApeUsu='{$this->ApeUsu}' WHERE IdUsu={$this->IdUsu} ;");

        endif;

        return $this;
    }

    public static function find(int $id): Usuario
    {
        $db = new BaseDeDatos();
        $db->query("SELECT * FROM usuario WHERE IdUsu = $id ;");


        return $db->getObject("Usuario");
    }

    public function __toString()
    {
        return $this->NomUsu . " " . $this->ApeUsu;
    }
}