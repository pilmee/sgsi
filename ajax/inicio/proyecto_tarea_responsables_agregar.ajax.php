<?php

    require_once "../../models/proyecto.model.php";
        $objProyecto = new Proyecto();
        
    $tarea = $_POST["tarea"];
    $empleado = $_POST["empleado"];
    
    if(!$objProyecto->AgregarResponsable($tarea, $empleado)){
        echo 'Ocurrio un error al agregar el responsable a la tarea.';
    }