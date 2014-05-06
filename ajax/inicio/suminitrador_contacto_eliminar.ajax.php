<?php

    $id = $_POST["id"];
    
    require_once "../../models/suministrador.model.php";
        $objSuministrador = new Suministrador();
    
    if(!$objSuministrador->EliminarContacto($id)){
        echo "El contacto no ha podido ser eliminado";
    }