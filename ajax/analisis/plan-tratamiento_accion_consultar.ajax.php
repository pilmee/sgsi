<?php

    require_once "../../models/plan_tratamiento.model.php";
    $objPlanTratamiento = new PlanTratamiento();
    
    $query = $objPlanTratamiento->consultarAccionesAsociadas($_GET["plan"]);
    
    while($reg = $query->fetchObject()){
        echo '<tr><td>'.$reg->nombre.'</td><td>'.$reg->nombres.'</td><td>'.$reg->recursos.'</td><td>'.substr($reg->plazo,0,10).'</td></tr>';
    }