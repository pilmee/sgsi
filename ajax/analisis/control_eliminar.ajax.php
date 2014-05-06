<?php
	require_once "../../models/amenaza.model.php";
    $objAmenaza = new Amenaza();

	$data = $_POST["control"];

	foreach($data as $index => $value){
		$r = $objAmenaza->EliminarControl($value);
		if($r){
			echo "Control eliminado.";
		}else{
			echo "Control no ha podido ser eliminado.";
		}
	}