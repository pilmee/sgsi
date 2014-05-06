<?php
    $acta = $_POST["acta"];
    $actividad = $_POST["actividad"];
    $descripcion = $_POST["descripcion"];
    
     require_once "../../models/acta_reunion.model.php";
        $objActaReunion = new Acta_Reunion();
        
    if(!$objActaReunion->AgregarPuntoTratado($acta,$actividad,$descripcion)){
        echo "El punto tratado no a podido ser agregado.";
    }
