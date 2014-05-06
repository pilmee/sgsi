<?php
    //if($_POST){
    date_default_timezone_set('America/Lima');
    
        $fecha = date("d/m/Y h:i:s");
        $objetivo = "Objetivo del Negocio ($fecha)";
        $empleado_responsable = null; /* TIPO DE ACTA NO DEFINIDO POR DEFECTO */
        $acta  = $_POST["acta"];
        
        require_once "../../models/objetivo.model.php";
        $objObjetivo = new Objetivo();
        
        if(!$objObjetivo->NuevoObjetivo($acta, $objetivo, "", "NULL")){
            echo "Ocurrio un error al momento de registrar un nuevo objetivo del negocion.";
        }
    //}
    