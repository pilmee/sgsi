<?php
	require_once "../../models/proyecto.model.php";
        $objProyecto = new Proyecto();

        //var_dump($_REQUEST);
	
	$idtarea = strip_tags(trim($_POST["txtIdTarea"]));
	$tarea = strip_tags(trim($_POST["txtTarea"]));
	$descripcion = strip_tags(trim($_POST["txtDescripcion"]));
	$inicio = !empty($_POST["txtFechaInicio"]) ? strip_tags(trim($_POST["txtFechaInicio"])) : 'NULL';
	$fin = !empty($_POST["txtFechaFin"]) ? strip_tags(trim($_POST["txtFechaFin"])) : 'NULL';
	$completado = isset($_POST["chkCompletado"]) ? 'TRUE' : 'FALSE';

	if(!$objProyecto->ActualizarTarea($idtarea, $tarea, $inicio, $fin, $completado, $descripcion)){
		echo "Ocurrio un error al actualizar la informacion de la tarea, intentelo nuevamente.";
	}else{
		echo "La informacion de la tarea fue actualizada exitosamente.";
	}