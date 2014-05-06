<?php
    require_once "../../models/objetivo.model.php";
        $objObjetivo = new Objetivo();
        
        $objetivo = $_POST["objetivo"];
        
        if(!$objObjetivo->EliminarObjetivo($objetivo)){
            echo "Ocurrio un error al eliminar el objetivo, intentelo nuevamente.";
        }