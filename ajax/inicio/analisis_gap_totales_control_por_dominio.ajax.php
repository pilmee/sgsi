<?php
	require_once "../../models/gap.model.php";
        $objGap = new Gap();

    $query_totales_control_dominio = $objGap->ConsultarTotalesControlSegunDominio();
    
    //$reg = $query_totales_control_dominio->fetchObject();

   	$data = [];
   		while ($reg = $query_totales_control_dominio->fetchObject()) {
			$elemento = [];
			foreach ($reg as $key => $value) {
				$elemento[$key] = $value;
			}
			$data[] = $elemento;
		}
	echo json_encode($data);