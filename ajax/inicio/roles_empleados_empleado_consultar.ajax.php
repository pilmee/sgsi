<?php
    require_once "../../models/empleado.model.php";
        $objEmpleado = new Empleado();
    
    $empresa = $_GET["empresa"];
    $query_empleado = $objEmpleado->ConsultarEmpleadosSinCargo($empresa);
        while($reg2 = $query_empleado->fetchObject()){
            echo '<option value="'.$reg2->idempleado.'">'.$reg2->apellidos.' '.$reg2->nombres.'</option>';
        }