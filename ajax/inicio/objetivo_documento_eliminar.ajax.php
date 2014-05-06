<?php

    $objetivo = $_POST["objetivo"];
    
    require_once "../../models/objetivo.model.php";
        $objObjetivo = new Objetivo();
    
    if(!$objObjetivo->EliminarDocumento($objetivo)){
        echo "El documento no ha podido ser eliminado";
    }