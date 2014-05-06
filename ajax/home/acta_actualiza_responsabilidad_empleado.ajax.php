<?php
    $acta = $_POST["acta"];
    $empleado = $_POST["empleado"];
    
    require_once "../../models/acta_reunion.model.php";
        $objActaReunion = new Acta_Reunion();
    
    if(!$objActaReunion->CambiarResponsabilidadEmpleado($acta, $empleado)){
        echo "La responsabilidad de acta del empleado no ha podido ser cambiada.";
    }
    