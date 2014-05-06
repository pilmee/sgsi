<?php

    require_once "../../models/objetivo.model.php";
        $objObjetivo = new Objetivo();
        
    $objetivo = $_POST["objetivo"];
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $empleado = $_POST["empleado"];
    $recurso = $_POST["recurso"];
    
    if(!$objObjetivo->AgregarObjetivoEspecifico($objetivo,$descripcion,$empleado,$recurso)){
        echo 'Ocurrio un error al agregar objetivo especifico al objetivo del negocio.';
    }