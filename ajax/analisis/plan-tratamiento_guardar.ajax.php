<?php
    require_once "../../models/plan_tratamiento.model.php";
    $objPlanTratamiento = new PlanTratamiento();
    
    $plan = $_POST['txtIDPlanTratamiento'];
    $nombre_plan = $_POST['txtNombrePlanTratamiento'];
    $soa = $_POST['txtControlSOAPlanTratamiento']!= "" ? $_POST['txtControlSOAPlanTratamiento'] : 'null';
    $empleado = $_POST['cboResponsablePlanTratamiento'] != "" ? $_POST['cboResponsablePlanTratamiento'] : 'null';
    $recursos = $_POST['txtRecursosPlanTratamiento'] != "" ? $_POST['txtRecursosPlanTratamiento'] : 'null';
    $plazo = $_POST['txtPlazoPlanTratamiento'] != "" ? $_POST['txtPlazoPlanTratamiento'] : 'null';
    $coste = $_POST['txtCosteAsociadoPlanTratamiento'] != "" ? $_POST['txtCosteAsociadoPlanTratamiento'] : 'null';
    $observaciones = $_POST['txtObservacionesPlanTratamiento'] != "" ? $_POST['txtObservacionesPlanTratamiento'] : 'null';
    
    //$lista_indicadores = $_POST['cboIndicadoresListaPlanTratamiento'];
  
    if(!$objPlanTratamiento->actualizarPlanTratamiento($plan, $nombre_plan, $soa, $empleado, $recursos, $plazo, $coste, $observaciones)){
        echo 'No se pudo actualiar el Plan de tratamiento, intentelo nuevamente.';
    }else{
        echo 'Plan de tratamiento Actualizado';
    }
    