<?php
    require_once "../../models/suministrador.model.php";
        $objSuministrador = new Suministrador();
        
        $suministrador = $_POST["suministrador"];
        
        if(!$objSuministrador->EliminarSuministrador($suministrador)){
            echo "Ocurrio un error al eliminar el suministrador, intentelo nuevamente.";
        }