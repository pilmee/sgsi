<?php

    $acta = $_POST["acta"];
    $area = $_POST["area"];
    
    require_once "../../models/inicio_alcance.model.php";
        $objInicioAlcance = new InicioAlcance();
    
    if(!$objInicioAlcance->EliminarLocalizacionFisica($acta, $area)){
        echo "El area no ha podido ser eliminada";
    }