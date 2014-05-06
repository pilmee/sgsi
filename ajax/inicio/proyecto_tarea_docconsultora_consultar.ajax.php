<?php
    require_once "../../models/proyecto.model.php";
        $objProyecto = new Proyecto();

    $tarea = $_GET["tarea"];
    $i = 1;

    $query = $objProyecto->ConsultarDocumentosConsultora($tarea);
    while($reg = $query->fetchObject()){
        echo '<tr><td>'.$i.'</td><td>'.$reg->documento.'</td><td><a href="#"" class="docconsultora" data-tarea="'.$reg->idtarea_docconsultora.'">Quitar</a></td></tr>';
        $i++;
    }
?>

<script>
    $("a.docconsultora").click(function(e){
        e.preventDefault()
        $.post("./ajax/inicio/proyecto_tarea_docconsultora_eliminar.ajax.php", { tarea: $(this).attr('data-tarea') }, function(r){
            TareaConsultarDocumentacionConsultora();
        });
    });
</script>