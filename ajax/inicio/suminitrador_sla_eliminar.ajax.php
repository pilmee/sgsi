<?php

    $id = $_POST["id"];
    
    require_once "../../models/suministrador.model.php";
        $objSuministrador = new Suministrador();
    
    if(!$objSuministrador->EliminarSLA($id)){
        echo "El SLA no ha podido ser eliminado";
    }