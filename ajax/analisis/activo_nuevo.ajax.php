<?php
    
    date_default_timezone_set('America/Lima');
    
        $fecha = date("d/m/Y h:i:s");
        $activo = "Activo ($fecha)";
        $empresa = $_POST["empresa"];

        require_once "../../models/activo.model.php";
        $objActivo = new Activo();
        
        if(!$objActivo->NuevaActivo($activo, $empresa, $fecha)){
            echo "Ocurrio un error, nuevo activo no a podido ser creada.";
        }