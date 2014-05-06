<?php
    require_once "../../models/proyecto.model.php";
        $objProyecto = new Proyecto();
        
        $tarea = $_POST["tarea"];
 
        
        if(!$objProyecto->EliminarDocumentoConsultora($tarea)){
            echo "Ocurrio un error al eliminar el documento de la sucursal, intentelo nuevamente.";
        }