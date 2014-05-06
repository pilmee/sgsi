<?php
	require_once "../../models/suministrador.model.php";
        $objSuministrador = new Suministrador();

    $idsuministrador = $_POST["id"];
    $servicio 	= strip_tags(trim($_POST["servicio"]));
    $inicio 	= strip_tags(trim($_POST["inicio"]));
    $fin 		= strip_tags(trim($_POST["fin"]));
    $soporte 	= strip_tags(trim($_POST["soporte"]));

    if(!$objSuministrador->AgregarContrato($idsuministrador, $servicio, $inicio, $fin, $soporte)){
    	echo 'El  contrato no ha podido ser agregado';
    }
