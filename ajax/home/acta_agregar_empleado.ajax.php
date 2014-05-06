<?php
    $acta = $_POST["acta"];
    $empleado = $_POST["empleado"];
    $responsable = $_POST["responsable"];
    
     require_once "../../models/acta_reunion.model.php";
        $objActaReunion = new Acta_Reunion();
        
    if(!$objActaReunion->AgregarEmpleado($acta,$empleado,$responsable)){
        echo "El empleado no a podido ser agregador a la lista de asistentes.";
    }
