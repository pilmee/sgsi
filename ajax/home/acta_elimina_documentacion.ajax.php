<?php

    $documento = $_POST["documento"];
    
    require_once "../../models/acta_reunion.model.php";
        $objActaReunion = new Acta_Reunion();
    
    if(!$objActaReunion->EliminarDocumentacion($documento)){
        echo "La documentacion seleccionada no ha podido ser eliminada.";
    }