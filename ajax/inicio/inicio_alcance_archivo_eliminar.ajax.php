<?php

    $acta = $_POST["acta"];
    $tipo = $_POST["tipo"];
    
    require_once "../../models/inicio_alcance.model.php";
        $objInicioAlcance = new InicioAlcance();
    
    if(!$objInicioAlcance->EliminarArchivo($tipo, $acta)){
        echo "El archivo no ha podido ser eliminado";
    }