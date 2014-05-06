<?php
    require_once "../../models/cargo.model.php";
        $objCargo = new Cargo();
        
        $obligacion = $_POST["obligacion"];
        
        if(!$objCargo->EliminarObligacion($obligacion)){
            echo "No se ha podido Eliminar la obligacion";
        }