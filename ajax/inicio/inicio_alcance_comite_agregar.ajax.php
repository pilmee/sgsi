<?php
    require_once "../../models/inicio_alcance.model.php";
        $objInicioAlcance = new InicioAlcance();
        
    $acta = $_POST["acta"];
    $cargo = $_POST["cargo"];
    
    if(!$objInicioAlcance->AgregarComite($acta, $cargo)){
        echo "Ocurrio un error al agregar cargo al comite.";
    }
    
    
