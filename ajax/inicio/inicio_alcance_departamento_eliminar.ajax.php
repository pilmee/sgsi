<?php

    $acta = $_POST["acta"];
    $departamento = $_POST["departamento"];
    
    require_once "../../models/inicio_alcance.model.php";
        $objInicioAlcance = new InicioAlcance();
    
    if(!$objInicioAlcance->EliminarDepartamento($acta, $departamento)){
        echo "El Departamento no ha podido ser eliminado";
    }