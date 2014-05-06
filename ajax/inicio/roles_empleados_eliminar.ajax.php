<?php
    require_once "../../models/empleado.model.php";
        $objEmpleado = new Empleado();
        
    $empleado = $_POST["cboRolesEmpleadoEmpleadoAsignado"];

    
    if(!$objEmpleado->EliminarCargo($empleado)){
        echo "No ha sido posible eliminar el cargo al empleado";
    }else{
        echo "El cargo fue retirado exitosamente.";
    }