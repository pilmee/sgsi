<?php
    require_once "../../models/inicio_alcance.model.php";
        $objInicioAlcance = new InicioAlcance();
        
    $acta = $_POST["acta"];
    $departamento = $_POST["departamento"];
    
    if(!$objInicioAlcance->AgregarDepartamento($acta, $departamento)){
        echo "Ocurrio un error al agregar departamento.";
    }
    
    
