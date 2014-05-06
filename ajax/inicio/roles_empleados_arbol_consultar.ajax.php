<?php
    require_once "../../models/empleado.model.php";
        $objEmpleado = new Empleado();
        
    require_once "../../models/cargo.model.php";
        $objCargo = new Cargo();
            
    $query_cargo = $objCargo->ConsultarCargos($_GET["empresa"]);
        while($reg = $query_cargo->fetchObject()){
            echo '<li>'.$reg->nombre;
            $query_empleado = $objEmpleado->ConsultarEmpleadoSegunCargo($reg->idcargo);
            if($query_empleado->rowCount() > 0){
                echo '<ul>';
                while($reg2 = $query_empleado->fetchObject()){
                    echo '<li>'.$reg2->apellidos.' '.$reg2->nombres.'</li>';
                }
                echo '</ul>';
            }
            echo '</li>';
        }
?>
<script>
    iniciaMenu('RolesEmpleadoArbol');
</script>