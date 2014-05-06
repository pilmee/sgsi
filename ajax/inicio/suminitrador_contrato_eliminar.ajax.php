<?php

    $id = $_POST["id"];
    
    require_once "../../models/suministrador.model.php";
        $objSuministrador = new Suministrador();
    
    if(!$objSuministrador->EliminarContrato($id)){
        echo "El contrato no ha podido ser eliminado";
    }