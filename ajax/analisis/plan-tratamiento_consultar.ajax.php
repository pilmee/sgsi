<?php
    require_once "../../models/plan_tratamiento.model.php";
    $objPlanTratamiento = new PlanTratamiento();
    
    $query = $objPlanTratamiento->consultarPlanesTratamiento();
    $i = 1;
    while($reg = $query->fetchObject()){
        echo '<tr><td><input id="chkPlanTratamiento'.$reg->idplan_tratamiento.'" name="chkPlanTratamiento" value="'.$reg->idplan_tratamiento.'" type="checkbox" style="margin:0" /></td><td><a href="#" class=".plan" onclick="modalPlanTratamiento('.$reg->idplan_tratamiento.'); return false;">'.$reg->nombres.'</a></td><td>'.$reg->idempleado.'</td><td>'.$reg->recursos.'</td><td>'.$reg->plazo.'</td></tr>';
        $i++;
    }
?>
<script>
    $("input[name=chkPlanTratamiento]").click(bloqueaOtrosPlanesTratamiento);
</script>