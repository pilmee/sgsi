<?php

	require_once "../../models/proyecto.model.php";
        $objProyecto = new Proyecto();

    $query_avance = $objProyecto->CalcularAvanceDelProyecto();
    $reg = $query_avance->fetchObject();

    echo json_encode($reg);