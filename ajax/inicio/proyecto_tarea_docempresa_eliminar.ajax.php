<?php
    require_once "../../models/proyecto.model.php";
        $objProyecto = new Proyecto();
        
        $tarea = $_POST["tarea"];
 
        
        if(!$objProyecto->EliminarDocumentoEmpresa($tarea)){
            echo "Ocurrio un error al eliminar el documento de la empresa, intentelo nuevamente.";
        }