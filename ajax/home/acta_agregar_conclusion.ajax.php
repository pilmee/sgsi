<?php
    $acta = $_POST["acta"];
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    
     require_once "../../models/acta_reunion.model.php";
        $objActaReunion = new Acta_Reunion();
        
    if(!$objActaReunion->AgregarConclusion($acta,$nombre,$descripcion)){
        echo "La conclusion no ha podido ser agregada.";
    }
