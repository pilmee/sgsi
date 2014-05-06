<?php
    date_default_timezone_set('America/Lima');
    $fecha = date("d/m/Y h:i:s");
    
    
    require_once "../../models/inicio_alcance.model.php";
        $objInicioAlcance = new InicioAlcance();
        
    $acta = $_POST["acta"];
        
    if(!$objInicioAlcance->RegistrarInicioAlcance($acta, "Nuevo Inicio y Alcance $fecha")){
        echo "No se ha podido registrar el Inicio alcance del Sistema";    
    }