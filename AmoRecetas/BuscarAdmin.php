<?php

require_once "libs/Database.php";

$db  = new BaseDeDatos();

	$servername = "localhost";
    $username = "root";
  	$password = "";
  	$dbname = "receta";

	$conn = new mysqli($servername, $username, $password, $dbname);
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
	  }

    $salida = "";
	
    $query = "SELECT receta.IdRec, NomRec, Tiempo, Raciones, Temporada, IngredientePrincipal,
	Posicion, Clase, Tipo, Uso, Metodo FROM ingrediente INNER join rec_ingrediente 
	on ingrediente.IdIngrediente = rec_ingrediente.idIngrediente INNER JOIN receta ON rec_ingrediente.IdRec = receta.IdRec ORDER BY NomRec";

    if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
    	$query = "SELECT receta.IdRec, NomRec, Tiempo, Raciones, Temporada, IngredientePrincipal,
		Posicion, Clase, Tipo, Uso, Metodo FROM ingrediente INNER join rec_ingrediente 
		on ingrediente.IdIngrediente = rec_ingrediente.idIngrediente INNER JOIN receta ON rec_ingrediente.IdRec = receta.IdRec WHERE 
			NomRec LIKE '%".$q."%' OR
			IngredientePrincipal LIKE '%".$q."%' OR
			Temporada LIKE '%".$q."%'";
    }

    $resultado = $conn->query($query);

    if ($resultado->num_rows>0) {
    	$salida.="";

    	while ($fila = $resultado->fetch_assoc()) {
			$salida.='<div class="col col-lg-4">
						<div class="card  text-white bg-success  mb-3 mx-auto" style="width:22rem;">
							<h5 class="card-header" style="text-align: center">'.$fila['NomRec'].'</h5>
							<div class="card-body">
								<h5 class="card-title">Ingrediente principal:
									'.$fila['IngredientePrincipal'].'</h5>
								<p class="card-text">Temporada:
                        			'.$fila['Temporada'].'</p>
								<a href="index.php?ope=verAdmin&con=receta&id='.$fila['IdRec'].'" class="btn btn-info">Ver mas</a>
							</div>
						</div>
					</div>
        	';

    	}
    	$salida.="";
    }else{
    	$salida.="NO HAY RECETAS";
    }


    echo $salida;

    $conn->close();
