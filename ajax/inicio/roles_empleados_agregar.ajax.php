<?php
    require_once "../../models/empleado.model.php";
        $objEmpleado = new Empleado();
        
    $empleado = $_POST["cboRolesEmpleadoEmpleado"];
    $cargo = $_POST["cboRolesEmpleadoCargo"];
    
    if(!$objEmpleado->AsignarCargo($empleado,$cargo)){
        echo "No ha sido posible asignar area a empleado";
    }else{
        echo "El empleado fue asignado al area exitosamente.";
    }