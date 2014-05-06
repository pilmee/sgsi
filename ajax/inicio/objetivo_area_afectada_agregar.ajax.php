<?php

    require_once "../../models/objetivo.model.php";
        $objObjetivo = new Objetivo();
        
    $objetivo = $_POST["objetivo"];
    $area = $_POST["area"];
    
    if(!$objObjetivo->AgregarAreaAfectada($objetivo,$area)){
        echo 'Ocurrio un error al agregar el area afectada al objetivo del negocio.';
    }