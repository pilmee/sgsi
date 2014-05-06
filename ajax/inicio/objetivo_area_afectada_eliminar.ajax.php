<?php

    $objetivo = $_POST["objetivo"];
    $area = $_POST["area"];
    
    require_once "../../models/objetivo.model.php";
        $objObjetivo = new Objetivo();
    
    if(!$objObjetivo->EliminarAreaAfectada($objetivo, $area)){
        echo "El área afectada no ha podido ser eliminada";
    }