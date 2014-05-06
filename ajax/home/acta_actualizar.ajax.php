<?php
    
    $acta = strip_tags(trim($_POST["txtIDActaReunion"]));
    $asunto = strip_tags(trim($_POST["txtAsunto"]));
    $fecha = strip_tags(trim($_POST["txtFecha"]));
    $tipoActa = $_POST["cboTipoActaReunion"];
    $duracion = strip_tags(trim($_POST["txtDuracion"]));
    $lugar = strip_tags(trim($_POST["txtLugar"]));
    $descripcion = strip_tags(trim($_POST["txtDescripcion"]));
    
     require_once "../../models/acta_reunion.model.php";
        $objActaReunion = new Acta_Reunion();
    
    if(!$objActaReunion->ActualizarActa($acta,$asunto,$fecha,$tipoActa,$duracion,$lugar,$descripcion)){
        echo "El Acta de Reunion no ha podido ser actualizada.";
    }else{
        echo "El Acta de Reunion se ha actualizado.";
    }