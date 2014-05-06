<?php
    require_once "../../models/inicio_alcance.model.php";
        $objInicioAlcance = new InicioAlcance();
        
    $acta = $_POST["acta"];
    $area = $_POST["area"];
    
    if(!$objInicioAlcance->AgregarLocalizacionFisica($acta, $area)){
        echo "Ocurrio un error al agregar responsable.";
    }
    
    
