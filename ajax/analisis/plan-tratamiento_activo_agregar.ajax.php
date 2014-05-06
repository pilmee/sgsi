<?php
    require_once "../../models/plan_tratamiento.model.php";
    $objPlanTratamiento = new PlanTratamiento();
    
    $plan = $_POST["plan"];
    $activo = $_POST["activo"];
    
    if(!$objPlanTratamiento->nuevoActivoRepercutido($plan, $activo)){
        echo "No se ha podido agregar activo a la lista de activos repercutidos.";
    }
    
?>