<?php

    $acta = $_POST["acta"];
    $empleado = $_POST["empleado"];
    
    require_once "../../models/inicio_alcance.model.php";
        $objInicioAlcance = new InicioAlcance();
    
    if(!$objInicioAlcance->EliminarResponsable($acta, $empleado)){
        echo "El responsable no ha podido ser eliminado";
    }