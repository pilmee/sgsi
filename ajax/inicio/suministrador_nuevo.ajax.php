<?php
    //if($_POST){
    date_default_timezone_set('America/Lima');
    
        $fecha = date("d/m/Y h:i:s");
        $razon_social = "Suministrador ($fecha)";
        $indicador_asociado = 1; /* DEFAULT INDICADOR ASOCIADO */
        $empresa = $_POST["empresa"];
        $descripcion = "";

        require_once "../../models/suministrador.model.php";
        $objSuministrador = new Suministrador();
        
        if(!$objSuministrador->NuevoSuministrador($empresa,$razon_social, $indicador_asociado, $descripcion)){
            echo "Ocurrio un error, el nuevo suministrador no ha podido ser registrado.";
        }
    //}
    