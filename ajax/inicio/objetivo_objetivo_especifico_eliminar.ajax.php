<?php

    $objetivo = $_POST["objetivo"];
    
    require_once "../../models/objetivo.model.php";
        $objObjetivo = new Objetivo();
    
    if(!$objObjetivo->EliminarObjetivoEspecifico($objetivo)){
        echo "El objetivo especifico no ha podido ser eliminada";
    }