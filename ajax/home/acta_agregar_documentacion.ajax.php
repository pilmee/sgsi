<?php

    $acta = $_REQUEST["acta"];
    $nombre = $_REQUEST["nombre"];
    $entrego = $_REQUEST["entrego"];
    $referencia = $_REQUEST["referencia"];
    
     require_once "../../models/acta_reunion.model.php";
        $objActaReunion = new Acta_Reunion();
        
    if(!$objActaReunion->AgregarDocumentacion($acta,$nombre,$entrego,$referencia)){
        echo "La documentacion no ha podido ser registrada.";
    }
