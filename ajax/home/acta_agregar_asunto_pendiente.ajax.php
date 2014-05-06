<?php
    $acta = $_POST["acta"];
    $accion = $_POST["accion"];
    $responsable = $_POST["responsable"];
    $plazo = $_POST["plazo"];
    
     require_once "../../models/acta_reunion.model.php";
        $objActaReunion = new Acta_Reunion();
        
    if(!$objActaReunion->AgregarAsuntoPendiente($acta,$accion,$responsable,$plazo)){
        echo "El asunto pendiente no ha podido ser agregado.";
    }
