<?php
	require_once "../../models/proyecto.model.php";
        $objProyecto = new Proyecto();

    $tarea = $_GET["tarea"];
    $i = 1;

    $query = $objProyecto->ConsultarDocumentosEmpresa($tarea);
    while($reg = $query->fetchObject()){
    	echo '<tr><td>'.$i.'</td><td>'.$reg->documento.'</td><td><a href="#"" class="docempresa" data-tarea="'.$reg->idtarea_docempresa.'">Quitar</a></td></tr>';
    	$i++;
    }
?>

<script>
	$("a.docempresa").click(function(e){
        e.preventDefault()
        $.post("./ajax/inicio/proyecto_tarea_docempresa_eliminar.ajax.php", { tarea: $(this).attr('data-tarea') }, function(r){
            TareaConsultarDocumentacionEmpresa();
        });
    });
</script>