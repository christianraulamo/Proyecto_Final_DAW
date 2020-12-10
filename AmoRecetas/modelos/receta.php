<?php

/**
 * Final degree project
 * 
 * @author CHRISTIAN RAÚL AMO OLSSON
 * @version 1.0
 */

require_once "libs/Database.php";

class Receta
{
    private $IdRec;
    private $NomRec;
    private $Tiempo;
    private $Raciones;
    private $Temporada;
    private $IngredientePrincipal;
    private $Posicion;
    private $Clase;
    private $Tipo;
    private $Uso;
    private $Metodo;
    private $IdIngredientePrincipal;

    public function __construct()
    {
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
     *
     * @access public
     * @return NomRec 
     */

    public function getNomRec()
    {
        return $this->NomRec;
    }

    /**
     *
     * @access public
     * @return NomRec 
     */

    public function setNomRec($NomRec)
    {
        $this->NomRec = $NomRec;

        return $this;
    }

    /**
     *
     * @access public
     * @return Tiempo 
     */

    public function getTiempo()
    {
        return $this->Tiempo;
    }

    /**
     *
     * @access public
     * @return Tiempo 
     */

    public function setTiempo($Tiempo)
    {
        $this->Tiempo = $Tiempo;

        return $this;
    }

    /**
     *
     * @access public
     * @return Raciones 
     */

    public function getRaciones()
    {
        return $this->Raciones;
    }

    /**
     *
     * @access public
     * @return Raciones 
     */

    public function setRaciones($Raciones)
    {
        $this->Raciones = $Raciones;

        return $this;
    }

    /**
     *
     * @access public
     * @return Temporada 
     */

    public function getTemporada()
    {
        return $this->Temporada;
    }

    /**
     *
     * @access public
     * @return Temporada 
     */

    public function setTemporada($Temporada)
    {
        $this->Temporada = $Temporada;

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
     *
     * @access public
     * @return Posicion 
     */

    public function getPosicion()
    {
        return $this->Posicion;
    }

    /**
     *
     * @access public
     * @return Posicion 
     */

    public function setPosicion($Posicion)
    {
        $this->Posicion = $Posicion;

        return $this;
    }

    /**
     *
     * @access public
     * @return Clase 
     */

    public function getClase()
    {
        return $this->Clase;
    }

    /**
     *
     * @access public
     * @return Clase 
     */
    
    public function setClase($Clase)
    {
        $this->Clase = $Clase;

        return $this;
    }

    /**
     *
     * @access public
     * @return Tipo 
     */
    
    public function getTipo()
    {
        return $this->Tipo;
    }

    /**
     *
     * @access public
     * @return Tipo 
     */
    
    public function setTipo($Tipo)
    {
        $this->Tipo = $Tipo;

        return $this;
    }

    /**
     *
     * @access public
     * @return Uso 
     */
    
    public function getUso()
    {
        return $this->Uso;
    }

    /**
     *
     * @access public
     * @return Uso 
     */
    
    public function setUso($Uso)
    {
        $this->Uso = $Uso;

        return $this;
    }

    /**
     *
     * @access public
     * @return Metodo 
     */
    
    public function getMetodo()
    {
        return $this->Metodo;
    }

    /**
     *
     * @access public
     * @return Metodo 
     */
    
    public function setMetodo($Metodo)
    {
        $this->Metodo = $Metodo;

        return $this;
    }

    /**
     *
     * @access public
     * @return IdIngredientePrincipal 
     */
    
    public function getIdIngredientePrincipal()
    {
        return $this->IdIngredientePrincipal;
    }

    /**
     *
     * @access public
     * @return IdIngredientePrincipal 
     */
    
    public function setIdIngredientePrincipal($IdIngredientePrincipal)
    {
        $this->IdIngredientePrincipal = $IdIngredientePrincipal;

        return $this;
    }

    /**
     * query with the recipe and ingredient table 
     * in the database and return all recipes
     *
     * @access public
     * @return $data 
     */
    
    public static function findAll()
    {
        $db = new BaseDeDatos();
        $db->query("SELECT receta.IdRec, NomRec, Tiempo, Raciones, Temporada, IngredientePrincipal,
                     Posicion, Clase, Tipo, Uso, Metodo FROM ingrediente INNER join rec_ingrediente 
                     on ingrediente.IdIngrediente = rec_ingrediente.idIngrediente INNER JOIN receta ON rec_ingrediente.IdRec = receta.IdRec");

        $data = [];
        while ($obj = $db->getObject("Receta"))
            array_push($data, $obj);

        return $data;
    }

    /**
     * query with the recipe and ingredient table
     * in the database and return a recipe
     *
     * @access public
     * @param number $id recipe id
     * @return $object Receta 
     */

    public static function find(int $id): Receta
    {
        $db = new BaseDeDatos();
        $db->query("SELECT receta.IdRec, NomRec, Tiempo, Raciones, Temporada, IngredientePrincipal,
        Posicion, Clase, Tipo, Uso, Metodo FROM ingrediente INNER join rec_ingrediente 
        on ingrediente.IdIngrediente = rec_ingrediente.idIngrediente INNER JOIN receta ON rec_ingrediente.IdRec = receta.IdRec WHERE receta.IdRec = $id ;");

        return $db->getObject("Receta");
    }

    /**
     * add the recipe to the database
     *
     * @access public
     * @return $this 
     */

    public function save()
    {
        $db  = new BaseDeDatos();

        if (is_null($this->IdRec)) :

            $sql = "INSERT INTO receta (NomRec, Tiempo, Raciones, Temporada, Posicion, Clase, Tipo, Uso, Metodo) 
                                VALUES ('{$this->NomRec}', '{$this->Tiempo}', '{$this->Raciones}',
                                '{$this->Temporada}', '{$this->Posicion}', '{$this->Clase}', 
                                '{$this->Tipo}', '{$this->Uso}', '{$this->Metodo}') ;";


            $db->query($sql);

            $this->IdRec = $db->lastId();

        else :

            // update the user
            $db->query("UPDATE receta SET NomRec='{$this->NomRec}', Tiempo='{$this->Tiempo}', Raciones='{$this->Raciones}', Temporada='{$this->Temporada}',
                 Posicion='{$this->Posicion}', Clase='{$this->Clase}', Tipo='{$this->Tipo}', Uso='{$this->Uso}', Metodo='{$this->Metodo}' WHERE IdRec={$this->IdRec} ;");

        endif;

        return $this;
    }

    /**
     * delete the recipe and the associated ingredient
     *
     * @access public
     */

    public function delete()
    {
        $db = new BaseDeDatos();
        $db->query("DELETE FROM receta WHERE IdRec={$this->IdRec} ;");
        $db->query("DELETE FROM rec_ingrediente WHERE IdRec={$this->IdRec} ;");
    }
}