<?php

    require_once "../../models/plan_tratamiento.model.php";
    $objPlanTratamiento = new PlanTratamiento();
    
    $plan = $_POST["plan"];
    $accion = $_POST["accion"];
    $empleado = $_POST["empleado"];
    $recursos = $_POST["recursos"];
    $plazo = $_POST["plazo"];
    
    //var_dump($_POST);
    
    if(!$objPlanTratamiento->nuevaAccionAsociada($plan, $accion, $empleado, $recursos, $plazo)){
        echo 'No se a podido registar la accion, intentelo nuevamente.';
    }