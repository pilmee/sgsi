<?php
    require_once "../../models/proyecto.model.php";
        $objProyecto = new Proyecto();
        
        $tarea = $_POST["tarea"];
        $empleado = $_POST["empleado"];
        
        if(!$objProyecto->EliminarResponsable($tarea, $empleado)){
            echo "Ocurrio un error al eliminar el responsable de tarea, intentelo nuevamente.";
        }