<?php

	require_once "../../models/gap.model.php";
        $objGap = new Gap();

    $query_totales_control = $objGap->ConsultarTotalesControl();
    $reg = $query_totales_control->fetchObject();

    echo json_encode($reg);