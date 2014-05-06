<?php
    require_once "../../models/cargo.model.php";
        $objCargo = new Cargo();
        
    $cargo = $_POST["cboRolesEmpleadoCargo"];
    $detalle = strip_tags(trim($_POST["txtRolesyFuncionesDetalle"]));
    
    if(!$objCargo->AgregarObligacion($cargo,$detalle)){
        echo "No ha sido posible asignar la funcion/obligacion a el cargo";
    }else{
        echo "La funcion/obligacion fue agregada exitosamente.";
    }