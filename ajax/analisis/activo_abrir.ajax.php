<?php
	require_once "../../models/activo.model.php";
    $objActivo = new Activo();

    $query = $objActivo->AbrirActivo($_GET["activo"]);
    $fetch = $query->fetchObject();
    echo json_encode($fetch);