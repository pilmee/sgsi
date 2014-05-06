<?php

    $asunto = $_POST["asunto"];
    
    require_once "../../models/acta_reunion.model.php";
        $objActaReunion = new Acta_Reunion();
    
    if(!$objActaReunion->EliminarAsuntoPendiente($asunto)){
        echo "El asunto pendiente no ha podido ser eliminado.";
    }