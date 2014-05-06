<?php
    require_once "../../models/plan_tratamiento.model.php";
    $objPlanTratamiento = new PlanTratamiento();
    
    $plan = $_GET["plan"];
    
    $query = $objPlanTratamiento->consultarControlesPropuestos($plan);
    $i = 1;
    
    while($reg = $query->fetchObject()){
        echo '<tr><td>'.$i.'</td><td>'.$reg->indice.' - '.$reg->detalle.'</td><td>'.substr($reg->fecha,0,10).'</td><td style="text-align:center;"><span class="glyphicon glyphicon-remove" onclick="EliminarControlPropuesto('.$reg->idplan_tratamiento.','.$reg->idgap.')"></span></span></td></tr>';
        $i++;
    }