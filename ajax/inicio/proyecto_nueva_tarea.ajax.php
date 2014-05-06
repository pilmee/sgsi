<?php

	require_once "../../models/proyecto.model.php";
        $objProyecto = new Proyecto();

    $objetivo = $_POST["objetivo"];

    if(!$objProyecto->NuevaTarea($objetivo)){
    	echo "No se a podido crear neuva tarea";
    }