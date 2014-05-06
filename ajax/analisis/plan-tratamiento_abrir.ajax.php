<?php
    header('Content-Type: application/json');
    
    require_once "../../models/plan_tratamiento.model.php";
    $objPlanTratamiento = new PlanTratamiento();
    
    $plan = $_GET["plan"];
    
    $query = $objPlanTratamiento->abrirPlanTratamiento($plan);
    $fetch = $query->fetchObject();
    
    $indicadores = [];
    $query_indicadores = $objPlanTratamiento->consultarIndicador($plan);
        while($fetch_indicadores = $query_indicadores->fetchObject()){
            $obj = [ "idplan_tratamiento" => $fetch_indicadores->idplan_tratamiento,
                     "idindicador" => $fetch_indicadores->idindicador,
                     "detalle" => $fetch_indicadores->detalle ];
            $indicadores[] = $obj;
        }
    
    $acciones = [];
    $query_acciones_asociadas = $objPlanTratamiento->consultarAccionesAsociadas($plan);
        while($fetch_acciones_asociadas = $query_acciones_asociadas->fetchObject()){
            $obj = [ "idacciones_asociadas_control" => $fetch_acciones_asociadas->idacciones_asociadas_control,
                     "nombre" => $fetch_acciones_asociadas->nombre,
                     "recursos" => $fetch_acciones_asociadas->recursos,
                     "plazo" => substr($fetch_acciones_asociadas->plazo,0,10),
                     "idplan_tratamiento" => $fetch_acciones_asociadas->idplan_tratamiento,
                     "idempleado" => $fetch_acciones_asociadas->idempleado,
                     "nombres" => $fetch_acciones_asociadas->nombres ];
            $acciones[] = $obj;
        }
    
    $amenazas = [];
    $query_amenazas_asociadas = $objPlanTratamiento->consultarAmenazaAsociada($plan);
        while($fetch_amenazas_asociadas = $query_amenazas_asociadas->fetchObject()){
            $obj =  [ "idplan_tratamiento" => $fetch_amenazas_asociadas->idplan_tratamiento,
                     "idamenaza" => $fetch_amenazas_asociadas->idamenaza,
                     "amenaza" => $fetch_amenazas_asociadas->amenaza,
                     "riesgo" => $fetch_amenazas_asociadas->detalle,
                     "color" => $fetch_amenazas_asociadas->color,
                     "activo" => $fetch_amenazas_asociadas->activo
                    ];
            $amenazas[] = $obj;
        }
    
    $activos = [];
    $query_activos_repercutidos = $objPlanTratamiento->consultarActivosRepercutidos($plan);
        while($fetch_activos_repercutidos = $query_activos_repercutidos->fetchObject()){
            $obj = [ "idplan_tratamiento" => $fetch_activos_repercutidos->idplan_tratamiento,
                     "idactivo" => $fetch_activos_repercutidos->idactivo,
                     "activo" => $fetch_activos_repercutidos->activo ];
            $activos[] = $obj;
        }
    
    
    
    $resultado = [];
    
    $resultado["datos_generales"] = $fetch;
    $resultado["indicadores"] = $indicadores;
    $resultado["acciones_asociadas"] = $acciones;
    $resultado["amenazas_asociadas"] = $amenazas;
    $resultado["activos_repercutidos"]= $activos;
    
    echo json_encode($resultado);
    