<?php

    require_once "../../models/proyecto.model.php";
        $objProyecto = new Proyecto();
        
    $tarea = $_POST["tarea"];
    $documento = $_POST["documento"];
    
    if(!$objProyecto->AgregarDocumentoConsultora($tarea, $documento)){
        echo 'Ocurrio un error al agregar el documento a la lista de documentos de la consultora.';
    }