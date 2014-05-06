<?php

    $acta = $_GET["acta"];
    require_once "../../models/acta_reunion.model.php";
        $objActaReunion = new Acta_Reunion();
    
    $query_acta_reunion_puntos_tratados = $objActaReunion->ConsultarPuntosTratados($acta);
    $i = 1;
    while($reg = $query_acta_reunion_puntos_tratados->fetchObject()){
        echo '<tr><td>'.$i.'</td><td>'.$reg->actividad.'</td><td>'.$reg->descripcion.'</td><td><a href="#" class="punto-tratado" data-id="'.$reg->idpuntos_tratados.'">Quitar</a></td></tr>';
        $i++;
    }
?>
<script>
    $("a.punto-tratado").click(function(e){
        e.preventDefault();
        var punto = $(this).attr("data-id");
        $.post("./ajax/home/acta_elimina_punto_tratado.ajax.php", { punto: punto }, function(r){
            console.log(r);
            ActaReunionConsultarPuntosTratados();
        });
    });
</script>