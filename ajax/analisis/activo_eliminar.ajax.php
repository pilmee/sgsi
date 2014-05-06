<?php

	require_once "../../models/activo.model.php";
    $objActivo = new Activo();
	
	if(!$objActivo->EliminarActivo($_POST['activo'])){
		echo 'Ocurrio un error al eliminar el (los) Activo(s)';
	}