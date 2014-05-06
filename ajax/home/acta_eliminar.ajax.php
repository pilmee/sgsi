<?php
    require_once "../../models/acta_reunion.model.php";
        $objActaReunion = new Acta_Reunion();
        
        $acta = $_POST["acta"];
        
        if(!$objActaReunion->EliminarActa($acta)){
            echo "Ocurrio un error al elimianr el acta, intentelo nuevamente.";
        }