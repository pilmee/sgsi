<?php

    $acta = $_POST["acta"];
    $cargo = $_POST["cargo"];
    
    require_once "../../models/inicio_alcance.model.php";
        $objInicioAlcance = new InicioAlcance();
    
    if(!$objInicioAlcance->EliminarComite($acta, $cargo)){
        echo "El comite no ha podido ser eliminado";
    }