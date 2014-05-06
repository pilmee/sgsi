<?php
    require_once "../../models/plan_tratamiento.model.php";
    $objPlanTratamiento = new PlanTratamiento();
    
    $arr_amenazas = $_POST["amenazas"];
    $plan = $_POST["plan"];
    
    if($objPlanTratamiento->asociarPlanAmenazas($plan, $arr_amenazas)){
        echo 'Las amenazas se asociaron correctamente con el plan de tratamiento.';
    }else{
        echo 'No se ha podido asociar amenazas y plan de tratamiento.';
    }
