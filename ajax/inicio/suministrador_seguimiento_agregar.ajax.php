<?php
	require_once "../../models/suministrador.model.php";
        $objSuministrador = new Suministrador();

   //var_dump($_POST);

    $idsuministrador = $_POST["id"];
    $usuario 	= strip_tags(trim($_POST["usuario"]));
    $fecha 	= strip_tags(trim($_POST["fecha"]));
    $descripcion 		= strip_tags(trim($_POST["descripcion"]));



    if(!$objSuministrador->AgregarSeguimiento($idsuministrador, $usuario, $fecha, $descripcion)){
    	echo 'El  registro de seguimiento no ha podido ser añadido';
    }

