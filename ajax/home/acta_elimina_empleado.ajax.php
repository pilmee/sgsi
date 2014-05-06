<?php
    
    require_once "../../models/acta_reunion.model.php";
        $objActaReunion = new Acta_Reunion();

    $acta = $_POST["acta"];
    $empleado = $_POST["empleado"];
    
    if(!$objActaReunion->EliminarEmpleado($acta,$empleado)){
        echo "El empleado no a podido ser retirado de la lista de asistentes.";
    }