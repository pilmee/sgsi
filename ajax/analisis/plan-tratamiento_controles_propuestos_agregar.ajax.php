<?php
    require_once "../../models/plan_tratamiento.model.php";
    $objPlanTratamiento = new PlanTratamiento();
    
    $plan = $_POST["cboPlanesDeTratamiento"];
    $control = $_POST["cboControles"];
    
    if(!$objPlanTratamiento->agregarControlPropuesto($plan, $control)){
        echo 'No se ha podido agregar el control al plan, o ya se encuentra agregado.';
    }