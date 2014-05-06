<?php
    require_once "../../models/plan_tratamiento.model.php";
    $objPlanTratamiento = new PlanTratamiento();
    
    $query = $objPlanTratamiento->consultarPlanesTratamiento();
    echo '<option value="">Seleccion un Plan de tratamiento</option>';
    while($reg = $query->fetchObject()){
        echo '<option value="'.$reg->idplan_tratamiento.'">'.$reg->nombres.'</option>';
    }
?>
