<?php
 require_once "../../models/empleado.model.php";
        $objEmpleado = new Empleado();
        
    $cargo = $_GET["cargo"];
    $query_empleado = $objEmpleado->ConsultarEmpleadoSegunCargo($cargo);
    while($reg2 = $query_empleado->fetchObject()){
        echo '<option value="'.$reg2->idempleado.'">'.$reg2->apellidos.' '.$reg2->nombres.'</option>';
    }
?>