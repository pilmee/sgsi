<?php
	require_once "../../models/gap.model.php";
        $objGap = new Gap();

    $opcion = $_POST["opcion"];    
    $control = $_POST["control"];
    $valor = $_POST["valor"];

    if(!$objGap->ActualizarControl($opcion, $control, $valor)){
    	echo "El control no ha podido ser actualizado";
    }