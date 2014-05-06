<?php
	require_once "../../models/amenaza.model.php";
    $objAmenaza = new Amenaza();

	$data = $_POST["amenaza"];

	foreach($data as $index => $value){
		$r = $objAmenaza->EliminarAmenaza($value);
		if($r){
			echo "Amenaza Eliminada.";
		}else{
			echo "Amenaza no ha podido ser eliminada";
		}
	}