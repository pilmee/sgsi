<?php

    $id = $_POST["id"];
    
    require_once "../../models/suministrador.model.php";
        $objSuministrador = new Suministrador();
    
    if(!$objSuministrador->EliminarSeguimiento($id)){
        echo "El seguimiento no ha podido ser eliminado";
    }