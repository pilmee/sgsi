<?php
    
    date_default_timezone_set('America/Lima');
    
        $fecha = date("d/m/Y h:i:s");
        $amenaza = "Amenaza ($fecha)";
        $activo = $_POST["activo"];

        require_once "../../models/amenaza.model.php";
        $objAmenaza = new Amenaza();
        
        if(!$objAmenaza->NuevaAmenaza($activo, $amenaza, $fecha)){
            echo "Ocurrio un error, nueva amenaza no a podido ser registrada.";
        }