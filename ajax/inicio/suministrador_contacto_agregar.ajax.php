<?php
	require_once "../../models/suministrador.model.php";
        $objSuministrador = new Suministrador();

   //var_dump($_POST);

    $idsuministrador = $_POST["id"];
    $nombre 	= strip_tags(trim($_POST["nombre"]));
    $cargo 	= strip_tags(trim($_POST["cargo"]));
    $telefono 		= strip_tags(trim($_POST["telefono"]));
    $email 	= strip_tags(trim($_POST["email"]));
    $comentario = strip_tags(trim($_POST["comentario"]));


    if(!$objSuministrador->AgregarContacto($idsuministrador, $nombre, $cargo, $telefono, $email, $comentario)){
    	echo 'El  contacto no ha podido ser agregado';
    }

