<?php

    $punto = $_POST["punto"];
    
    require_once "../../models/acta_reunion.model.php";
        $objActaReunion = new Acta_Reunion();
    
    if(!$objActaReunion->EliminarPuntoTratado($punto)){
        echo "El punto tratado no ha podido ser eliminado";
    }