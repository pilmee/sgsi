
<?php

	require_once "../../models/gap.model.php";
        $objGap = new Gap();

    require_once "../../models/proyecto.model.php";
        $objProyecto = new Proyecto();

    $pag = "proyecto-gestion";

    $dominio = $_POST["dominio"];
    $class = "";
    $i = 0;

    $query_objetivos = $objGap->ConsultarObjetivos($dominio);
    while ($reg = $query_objetivos->fetchObject()) {
		if($i%2){ $class = "active";} else{ $class = ""; }
        echo '<tr class="dominio objetivo dom'.$reg->id_padre.' '.$class.'" data-id="'.$reg->id.'" style="font-size:0.9em">
        		<td style="">&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-folder-close dominio-detalle" data-id="'.$reg->id.'"  data-estado="comprimido"></span></td>
        					<td>'.$reg->indice.' - '.$reg->detalle.'</td>
        					<td></td>
        					<td></td>
        					<td></td>
        					<td></td>
        				</tr>';
        				$i++;

        	$query_tareas = $objProyecto->ConsultarTareas($reg->id);
        	while ($reg_tarea = $query_tareas->fetchObject()) {
        		echo '<tr class="tarea'.$reg->id_padre.'" style="font-size:0.9em">
        				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-tasks"></sapn></td>
        				<td><a href="?pag='.$pag.'&tarea='.$reg_tarea->idtarea.'">'.$reg_tarea->detalle.'</a></td>
        				<td></td>
        				<td style="text-align:center">';
        				if($reg_tarea->completado){
        					echo '<span class="glyphicon glyphicon-ok-circle"></span>';
        				}else{
        					if(!empty($reg_tarea->inicio) && !empty($reg_tarea->fin)){
        						$fechaInicio = new DateTime($reg_tarea->inicio);
	        					$fechaFin    = new DateTime($reg_tarea->fin);
	        					$fechaDiferencia = $fechaInicio->diff($fechaFin);
	        					echo $fechaDiferencia->format("%R%a días");
        					}        					
        				}
        		echo '  </td>
        				<td style="text-align:center">'.$reg_tarea->inicio.'</td>
        				<td style="text-align:center">'.$reg_tarea->fin.'</td>
        			  </tr>';
        	}
    }
?>
<script>
	var tr_show = false;
    $("tr.objetivo").click(function(){
    	var id = $(this).attr("data-id");
    	LimpiarSeleccion();
    	if(tr_show){
    		tr_show = false;
    		$(this).removeClass("success");	
    		$("input#txtIdObjetivoHelpper").val("");
    		$("input#txtIdObjetivoDetalleHelpper").val("");
    		$("button#btnGestionProyectoNuevaTarea").attr("disabled","disabled");
    	}else{
    		tr_show = true;
    		$(this).addClass("success");
    		$("input#txtIdObjetivoHelpper").val(id);
    		$("input#txtIdObjetivoDetalleHelpper").val($(this).attr("class"));
    		$("button#btnGestionProyectoNuevaTarea").removeAttr("disabled");
    	}
    	
    });

    function LimpiarSeleccion(){
    	$("tr.objetivo").each(function(){
    		$(this).removeClass("success");
    	});
    }
</script>
<style>
	tr.objetivo:hover{
		cursor: pointer;
	}
</style>