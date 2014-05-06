<?php
    require_once "../../models/cargo.model.php";
        $objCargo = new Cargo();
        
    $cargo = $_POST["cboRolesEmpleadoCargo"];
    $detalle = strip_tags(trim($_POST["txtRolesyCompetenciasDetalle"]));
    
    if(!$objCargo->AgregarCompetencia($cargo,$detalle)){
        echo "No ha sido posible asignar la competencia a el cargo";
    }else{
        echo "La competencia fue agregada exitosamente.";
    }