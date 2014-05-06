<?php
    
    date_default_timezone_set('America/Lima');
    
        $fecha = date("d/m/Y h:i:s");
        require_once "../../models/plan_tratamiento.model.php";
        
        $objPlanTratamiento = new PlanTratamiento();
        
        $nombre = "Nuevo Control Asociado - $fecha";
        
        if(!$objPlanTratamiento->nuevoPlanTratamiento($nombre, $fecha)){
            echo 'Ocurrio un error al crear el plan de tratamiento, intentelo nuevamente.';
        }