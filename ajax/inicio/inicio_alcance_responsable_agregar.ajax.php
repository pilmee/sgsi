<?php
    require_once "../../models/inicio_alcance.model.php";
        $objInicioAlcance = new InicioAlcance();
        
    $acta = $_POST["acta"];
    $empleado = $_POST["empleado"];
    
    if(!$objInicioAlcance->AgregarResponsable($acta, $empleado)){
        echo "Ocurrio un error al agregar responsable.";
    }
    
    
