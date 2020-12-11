<?php

/**
 * Final degree project
 * 
 * @author CHRISTIAN RAÚL AMO OLSSON
 * @version 1.0
 */

require_once "BaseController.php";
require_once "libs/Ruta.php";
require_once "modelos/receta.php";
require_once "modelos/ingrediente.php";
require_once "modelos/rec_ingrediente.php";
require_once "libs/sesion.php";

class RecetaController extends BaseController
{
    private $sesion;

    public function __construct()
    {
        parent::__construct();
        
    }


    /**
     * Redirect to the list of recipes
     *
     * @access public
     */
    public function listar()
    {
        $this->sesion = Sesion::getInstance();
        // check if there is an active session
        if (!$this->sesion->checkActiveSession()) :
            echo $this->twig->render("login.php.twig");
        endif;

        $dat = Receta::findAll();
        echo $this->twig->render("verRecetas.php.twig", ['dat' => $dat]);
    }

    /**
     * Redirect to the list of recipes
     *
     * @access public
     */
    
    public function listarAdmin()
    {
        $this->sesion = Sesion::getInstance();
        // check if there is an active session
        if (!$this->sesion->checkActiveSession()) :
            echo $this->twig->render("login.php.twig");
        endif;

        $dat = Receta::findAll();
        echo $this->twig->render("verRecetasAdmin.php.twig", ['dat' => $dat]);
    }

    /**
     * Displays the recipe information
     *
     * @access public
     * @param number $id id Recipe ID
     */

    public function ver()
    {
        $this->sesion = Sesion::getInstance();
        // check if there is an active session
        if (!$this->sesion->checkActiveSession()) :
            echo $this->twig->render("login.php.twig");
        endif;
        $dat = Receta::find($_GET["id"]);

        echo $this->twig->render("infoReceta.php.twig", ['dat' => $dat]);
    }

    /**
     * Displays the recipe information
     *
     * @access public
     * @param number $id id Recipe ID
     */

    public function verAdmin()
    {
        $this->sesion = Sesion::getInstance();
        // check if there is an active session
        if (!$this->sesion->checkActiveSession()) :
            echo $this->twig->render("login.php.twig");
        endif;
        $dat = Receta::find($_GET["id"]);

        echo $this->twig->render("infoRecetaAdmin.php.twig", ['dat' => $dat]);
    }

    /**
     * Add a recipe
     *
     * @access public
     * @param string $nomRec recipe name
     * @param string $Tiempo recipe preparation time
     * @param string $Raciones Recipe servings
     * @param string $Temporada Recipe season
     * @param string $Posicion Position in which the rectum is eaten (appetizer, main course ...)
     * @param string $Clase Recipe class (Soup, pasta, meat ...)
     * @param string $Tipo Recipe type (Vegan, vegetarian ...)
     * @param string $Uso Use of the recipe (Party, picnic ...)
     * @param string $Metodo Preparation method of the recipe (oven, griddle, stew ...)
     * @param string $IngredientePrincipal Main ingredient of the rectea
     */

    public function anadir()
    {
        $this->sesion = Sesion::getInstance();
        // check if there is an active session
        if (!$this->sesion->checkActiveSession()) :
            echo $this->twig->render("login.php.twig");
        endif;

        if (!isset($_GET["nomRec"])) {
            $datG = Ingrediente::findAll();

            $dat = Receta::findAll();
            echo $this->twig->render("addRecetas.php.twig", ['datG' => $datG]);
        } else if (($_GET["IngredientePrincipal"] === "Otro")) {

            // create and save the recipe
            $nomRec = $_GET["nomRec"];
            $Tiempo = $_GET["Tiempo"];
            $Raciones = $_GET["Raciones"];
            $Temporada = $_GET["Temporada"];
            $Posicion = $_GET["Posicion"];
            $Clase = $_GET["Clase"];
            $Tipo = $_GET["Tipo"];
            $Uso = $_GET["Uso"];
            $Metodo = $_GET["Metodo"];
            $IngredientePrincipal = $_GET["IngredientePrincipal"];

            $rec = new Receta();

            // create the recipe
            $rec->setNomRec($nomRec);
            $rec->setTiempo($Tiempo);
            $rec->setRaciones($Raciones);
            $rec->setTemporada($Temporada);
            $rec->setPosicion($Posicion);
            $rec->setClase($Clase);
            $rec->setTipo($Tipo);
            $rec->setUso($Uso);
            $rec->setMetodo($Metodo);

            // save the recipe
            $rec->save();

            $IdRec = $rec->getIdRec();

            echo $this->twig->render("addIngredientePrincipal.php.twig", ['IdRec' => $IdRec]);
        } else {

            // create and save the recipe
            $nomRec = $_GET["nomRec"];
            $Tiempo = $_GET["Tiempo"];
            $Raciones = $_GET["Raciones"];
            $Temporada = $_GET["Temporada"];
            $Posicion = $_GET["Posicion"];
            $Clase = $_GET["Clase"];
            $Tipo = $_GET["Tipo"];
            $Uso = $_GET["Uso"];
            $Metodo = $_GET["Metodo"];
            $IngredientePrincipal = $_GET["IngredientePrincipal"];

            $rec = new Receta();

            // create the recipe
            $rec->setNomRec($nomRec);
            $rec->setTiempo($Tiempo);
            $rec->setRaciones($Raciones);
            $rec->setTemporada($Temporada);
            $rec->setPosicion($Posicion);
            $rec->setClase($Clase);
            $rec->setTipo($Tipo);
            $rec->setUso($Uso);
            $rec->setMetodo($Metodo);

            // save the recipe
            $rec->save();

            $IdRec = $rec->getIdRec();

            $per = new Rec_Ingrediente();
            $per->setIdRec($IdRec);
            $per->setIdIngrediente($IngredientePrincipal);

            $per->save();

            // redirect to the index

            $dat = Receta::findAll();
            echo $this->twig->render("verRecetasAdmin.php.twig", ['dat' => $dat]);
        }
    }

    /**
     * add new main ingredient
     *
     * @access public
     * @param string $IngredientePrincipal Main ingredient of the rectea
     * @param string $IdRec recipe id
     */

    public function anadirIngrediente()
    {
        $this->sesion = Sesion::getInstance();
        // check if there is an active session
        if (!$this->sesion->checkActiveSession()) :
            echo $this->twig->render("login.php.twig");
        endif;

        // create and save genre

        $IngredientePrincipal = $_GET["IngredientePrincipal"];
        $IdRec = $_GET["IdRec"];


        $Ing = new Ingrediente();

        // create the ingredient
        $Ing->setIngredientePrincipal($IngredientePrincipal);


        // save the genre
        $Ing->save();

        $IdIng = $Ing->getIdIngrediente();

        // create and save ingredient
        $Rec_Ing = new Rec_Ingrediente();
        $Rec_Ing->setIdRec($IdRec);
        $Rec_Ing->setIdIngrediente($IdIng);

        $Rec_Ing->save();

        $dat = Receta::findAll();

        // redirect to the index
        echo $this->twig->render("verRecetasAdmin.php.twig", ['dat' => $dat]);
    }

    /**
     * redirect to recipe edit
     *
     * @access public
     * @param string $id recipe id
     */

    public function editar()
    {
        $this->sesion = Sesion::getInstance();
        // check if there is an active session
        if (!$this->sesion->checkActiveSession()) :
            echo $this->twig->render("login.php.twig");
        endif;
        $id = $_GET["id"];
        $dat = Receta::find($id);
        echo $this->twig->render("editar.php.twig", ['dat' => $dat]);
    }

    /**
     * edit the recipe
     *
     * @access public
     * @param string $id recipe id
     * @param string $nomRec recipe name
     * @param string $Tiempo recipe preparation time
     * @param string $Raciones Recipe servings
     * @param string $Temporada Recipe season
     * @param string $Posicion Position in which the rectum is eaten (appetizer, main course ...)
     * @param string $Clase Recipe class (Soup, pasta, meat ...)
     * @param string $Tipo Recipe type (Vegan, vegetarian ...)
     * @param string $Uso Use of the recipe (Party, picnic ...)
     * @param string $Metodo Preparation method of the recipe (oven, griddle, stew ...)
     * @param string $IngredientePrincipal Main ingredient of the rectea
     */

    public function modificar()
    {

        $this->sesion = Sesion::getInstance();
        // check if there is an active session
        if (!$this->sesion->checkActiveSession()) :
            echo $this->twig->render("login.php.twig");
        endif;

        $id = $_GET["id"];
        $nomRec = $_GET["nomRec"];
        $Tiempo = $_GET["Tiempo"];
        $Raciones = $_GET["Raciones"];
        $Temporada = $_GET["Temporada"];
        $Posicion = $_GET["Posicion"];
        $Clase = $_GET["Clase"];
        $Tipo = $_GET["Tipo"];
        $Uso = $_GET["Uso"];
        $Metodo = $_GET["Metodo"];
        $IngredientePrincipal = $_GET["IngredientePrincipal"];

        $rec = new Receta();

        $rec->setIdRec($id);
        $rec->setNomRec($nomRec);
        $rec->setTiempo($Tiempo);
        $rec->setRaciones($Raciones);
        $rec->setTemporada($Temporada);
        $rec->setPosicion($Posicion);
        $rec->setClase($Clase);
        $rec->setTipo($Tipo);
        $rec->setUso($Uso);
        $rec->setMetodo($Metodo);

        $rec->save();

        $IdRec = $rec->getIdRec();

        $per = new Rec_Ingrediente();
        $per->setIdRec($IdRec);
        $per->setIdIngrediente($IngredientePrincipal);

        $per->save();


        $dat = Receta::findAll();

        // redirect to the index
        echo $this->twig->render("verRecetasAdmin.php.twig", ['dat' => $dat]);
    }

    /**
     * delete the recipe
     *
     * @access public
     * @param string $id recipe id
     */

    public function borrar()
    {
        $this->sesion = Sesion::getInstance();
        // check if there is an active session
        if (!$this->sesion->checkActiveSession()) :
            echo $this->twig->render("login.php.twig");
        endif;
        $ids = $_GET["id"];
        $rec = Receta::find($ids);
        $rec->delete();

        $dat = Receta::findAll();

        // redirect to the index
        echo $this->twig->render("verRecetasAdmin.php.twig", ['dat' => $dat]);
    }
}