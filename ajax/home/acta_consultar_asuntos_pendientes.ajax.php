<?php

    $acta = $_GET["acta"];
    require_once "../../models/acta_reunion.model.php";
        $objActaReunion = new Acta_Reunion();
    
    $query_acta_reunion_asuntos_pendientes = $objActaReunion->ConsultarAsuntosPendientes($acta);
    $i = 1;
    while($reg = $query_acta_reunion_asuntos_pendientes->fetchObject()){
        echo '<tr><td>'.$i.'</td><td>'.$reg->accion.'</td><td>'.$reg->apellidos.' '.$reg->nombres.'</td><td>'.$reg->plazo.'</td><td><a href="#" class="asunto-pendiente" data-id="'.$reg->idasuntos_pendientes.'">Quitar</a></td></tr>';
        $i++;
    }
?>
<script>
    $("a.asunto-pendiente").click(function(e){
        e.preventDefault();
        var asunto = $(this).attr("data-id");
        $.post("./ajax/home/acta_elimina_asunto_pendiente.ajax.php", { asunto: asunto }, function(r){
            console.log(r);
            ActaReunionConsultarAsuntosPendientes();
        });
    });
</script>