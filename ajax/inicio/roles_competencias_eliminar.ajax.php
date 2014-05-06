<?php
    require_once "../../models/cargo.model.php";
        $objCargo = new Cargo();
        
        $competencia = $_POST["competencia"];
        
        if(!$objCargo->EliminarCompetencia($competencia)){
            echo "No se ha podido Eliminar la competencia";
        }