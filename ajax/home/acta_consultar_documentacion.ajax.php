<?php

    $acta = $_GET["acta"];
    require_once "../../models/acta_reunion.model.php";
        $objActaReunion = new Acta_Reunion();
    
    $query_acta_reunion_documentacion = $objActaReunion->ConsultarDocumentacion($acta);
    $i = 1;
    while($reg = $query_acta_reunion_documentacion->fetchObject()){
        echo '<tr><td>'.$i.'</td><td>'.$reg->nombre.'</td><td>'.$reg->entrego.'</td><td>'.$reg->referencia.'</td><td><a href="#" class="documentacion" data-id="'.$reg->iddocumentacion_acta.'">Quitar</a></td></tr>';
        $i++;
    }
?>
<script>
    $("a.documentacion").click(function(e){
        e.preventDefault();
        var documento = $(this).attr("data-id");
        $.post("./ajax/home/acta_elimina_documentacion.ajax.php", { documento: documento }, function(r){
            console.log(r);
            ActaReunionConsultarDocumentacion();
        });
    });
</script>