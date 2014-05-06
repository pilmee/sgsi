<?php
	require_once "../../models/proyecto.model.php";
        $objProyecto = new Proyecto();

    $tarea = $_GET["tarea"];
    $i = 1;

    $query = $objProyecto->ConsultarResponsables($tarea);
    while($reg = $query->fetchObject()){
    	echo '<tr><td>'.$i.'</td>
                  <td>'.$reg->apellidos.' '.$reg->nombres.'</td>
                  <td>'.$reg->cargo.'</td><td>'.$reg->empresa.'</td>
                  <td><a href="#"" class="tarea-responsable" data-tarea="'.$reg->idtarea.'" data-empleado="'.$reg->idempleado.'">Quitar</a></td></tr>';
    	$i++;
    }
?>

<script>
	$("a.tarea-responsable").click(function(e){
        e.preventDefault()
        $.post("./ajax/inicio/proyecto_tarea_responsables_eliminar.ajax.php", { tarea: $(this).attr('data-tarea'), empleado:$(this).attr('data-empleado') }, function(r){
            TareaConsultarResponsables();
        });
    });
</script>