<?php

    $acta = $_GET["acta"];
    require_once "../../models/acta_reunion.model.php";
        $objActaReunion = new Acta_Reunion();
    
    $query_acta_reunion_conclusiones = $objActaReunion->ConsultarConclusiones($acta);
    $i = 1;
    while($reg = $query_acta_reunion_conclusiones->fetchObject()){
        echo '<tr><td>'.$i.'</td><td>'.$reg->nombre.'</td><td>'.$reg->descripcion.'</td><td><a href="#" class="conclusion" data-id="'.$reg->idconclusiones_acta.'">Quitar</a></td></tr>';
        $i++;
    }
?>
<script>
    $("a.conclusion").click(function(e){
        e.preventDefault();
        var conclusion = $(this).attr("data-id");
        $.post("./ajax/home/acta_elimina_conclusion.ajax.php", { conclusion: conclusion }, function(r){
            console.log(r);
            ActaReunionConsultarConclusiones();
        });
    });
</script>