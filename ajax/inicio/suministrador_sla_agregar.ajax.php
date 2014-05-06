<?php
	require_once "../../models/suministrador.model.php";
        $objSuministrador = new Suministrador();

   var_dump($_POST);

    $idsuministrador = $_POST["id"];
    $nombre 	= strip_tags(trim($_POST["sla"]));
    $descripcion 	= strip_tags(trim($_POST["asd"]));

    if(!$objSuministrador->AgregarSLA($idsuministrador, $nombre, $descripcion)){
    	echo 'El SLA no ha podido ser agregado';
    }
