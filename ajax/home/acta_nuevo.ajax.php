<?php
    //if($_POST){
    date_default_timezone_set('America/Lima');
    
        $fecha = date("d/m/Y h:i:s");
        $asunto = "Acta de Reunion ($fecha)";
        $tipo_acta_reunion = 5; /* TIPO DE ACTA NO DEFINIDO POR DEFECTO */
        
        require_once "../../models/acta_reunion.model.php";
        $objActaReunion = new Acta_Reunion();
        
        if(!$objActaReunion->NuevaActaReunion($tipo_acta_reunion,$asunto,$fecha)){
            echo "Ocurrio un error, nueva acta de reunion no a podido ser creada.";
        }
    //}
    