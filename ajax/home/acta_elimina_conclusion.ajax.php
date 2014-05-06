<?php

    $conclusion = $_POST["conclusion"];
    
    require_once "../../models/acta_reunion.model.php";
        $objActaReunion = new Acta_Reunion();
    
    if(!$objActaReunion->EliminarConclusion($conclusion)){
        echo "La conclusion seleccionada no ha podido ser eliminada.";
    }