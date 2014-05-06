<?php

    $acta = $_POST["acta"];
    $cargo = $_POST["cargo"];
    
    require_once "../../models/inicio_alcance.model.php";
        $objInicioAlcance = new InicioAlcance();
    
    if(!$objInicioAlcance->EliminarInterface($acta, $cargo)){
        echo "La interface no ha podido ser eliminada";
    }