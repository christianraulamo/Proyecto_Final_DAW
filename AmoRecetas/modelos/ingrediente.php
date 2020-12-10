<?php

/**
 * Final degree project
 * 
 * @author CHRISTIAN RAÚL AMO OLSSON
 * @version 1.0
 */

require_once "libs/Database.php";

class Ingrediente
{
    private $IdIngrediente;
    private $IngredientePrincipal;

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
     * @return IngredientePrincipal 
     */

    public function getIngredientePrincipal()
    {
        return $this->IngredientePrincipal;
    }

    /**
     *
     * @access public
     * @return IngredientePrincipal 
     */

    public function setIngredientePrincipal($IngredientePrincipal)
    {
        $this->IngredientePrincipal = $IngredientePrincipal;

        return $this;
    }

    /**
     * query with the ingredient table 
     * in the database and return all ingredient
     *
     * @access public
     * @return $data 
     */

    public static function findAll()
    {
        $db = new BaseDeDatos();
        $db->query("SELECT * From ingrediente");

        $data = [];
        while ($obj = $db->getObject("Ingrediente"))
            array_push($data, $obj);

        return $data;
    }

    /**
     * add the ingredient to the database
     *
     * @access public
     * @return $this 
     */

    public function save()
    {
        $db  = new BaseDeDatos();

        if (is_null($this->IdIngrediente)) :

            $sql = "INSERT INTO ingrediente (IngredientePrincipal) 
                                VALUES ('{$this->IngredientePrincipal}') ;";


            $db->query($sql);

            $this->IdIngrediente = $db->lastId();

        endif;

        return $this;
    }
}