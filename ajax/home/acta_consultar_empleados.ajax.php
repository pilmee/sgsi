<?php

    require_once "../../models/acta_reunion.model.php";
        $objActaReunion = new Acta_Reunion();
        
        $acta = $_GET["acta"];
        
    $query_acta_reunion_empleados = $objActaReunion->ConsultarEmpleados($acta);
    $i = 1;
    while($reg = $query_acta_reunion_empleados->fetchObject()){
        echo '<tr><td>'.$i.'</td><td>'.$reg->apellidos.' '.$reg->nombres.'</td><td>'.$reg->cargo.'</td><td style="text-align:center"><input type="checkbox" name="ActaReunionEmpleadoResponsable[]" ';
            if($reg->responsable_acta){
                echo ' checked ';
            }
        echo ' onclick="ActaReunionEmpleadoActualizaResponsabilidad('.$reg->idacta_reunion.','.$reg->idempleado.')" /></td><td><a href="#" data-acta="'.$reg->idacta_reunion.'"  data-empleado="'.$reg->idempleado.'"  class="actaReunionAsistente">Quitar</a></td></tr>';
        $i++;
    }
?>
<script>
    $("a.actaReunionAsistente").click(function(e){
        e.preventDefault()
        $.post("./ajax/home/acta_elimina_empleado.ajax.php", { acta: $(this).attr('data-acta'), empleado: $(this).attr('data-empleado') }, function(r){
            console.log(r);
            ActaReunionConsultarEmpelados();
        });
    });
</script>