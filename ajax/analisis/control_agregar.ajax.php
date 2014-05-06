<?php
    
    date_default_timezone_set('America/Lima');
    
        $fecha = date("d/m/Y h:i:s");


        $amenaza = $_POST["amenaza"];
        $detalle = $_POST["detalle"];
        $fi = $_POST["fi"];
        $ff = $_POST["ff"];
        $costo = $_POST["costo"];
        $responsable = empty($_POST["responsable"]) ? 'NULL' : $_POST["responsable"];

        require_once "../../models/amenaza.model.php";
        $objAmenaza = new Amenaza();
        
        if(!$objAmenaza->NuevoControl($amenaza, $detalle, $fi, $ff, $costo, $responsable)){
            echo "Ocurrio un error al crear el control.";
        }