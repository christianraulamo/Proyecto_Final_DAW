<?php

/**
 * Final degree project
 * 
 * @author CHRISTIAN RAÚL AMO OLSSON
 * @version 1.0
 */

require_once "libs/Database.php";

class Rec_Ingrediente
{
    private $IdIngrediente;
    private $IdRec;

    public function __construct()
    {
    }

    /**
     *
     * @access public
     * @return IdIngrediente 
     */

    public function getIdIngrediente()
    {
        return $this->IdIngrediente;
    }

    /**
     *
     * @access public
     * @return IdIngrediente 
     */

    public function setIdIngrediente($IdIngrediente)
    {
        $this->IdIngrediente = $IdIngrediente;

        return $this;
    }

    /**
     *
     * @access public
     * @return IdRec 
     */

    public function getIdRec()
    {
        return $this->IdRec;
    }

    /**
     *
     * @access public
     * @return IdRec 
     */

    public function setIdRec($IdRec)
    {
        $this->IdRec = $IdRec;

        return $this;
    }

    /**
     * add the IdRec and IdIngrediente to the database
     *
     * @access public
     * @return $this 
     */

    public function save()
    {
        $db  = new BaseDeDatos();


        $sql = "INSERT INTO rec_ingrediente (IdRec, IdIngrediente) 
                                VALUES ('{$this->IdRec}','{$this->IdIngrediente}') ;";

        $db->query($sql);



        return $this;
    }
}