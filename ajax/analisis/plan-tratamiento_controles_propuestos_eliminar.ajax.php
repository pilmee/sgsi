<?php
    require_once "../../models/plan_tratamiento.model.php";
    $objPlanTratamiento = new PlanTratamiento();
    
    $plan = $_POST["plan"];
    $control = $_POST["control"];
    
    if(!$objPlanTratamiento->eliminarControlPropuesto($plan, $control)){
        echo 'No se a podido eliminar el control propuesto.';
    }