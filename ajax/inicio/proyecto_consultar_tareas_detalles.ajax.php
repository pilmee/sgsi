<?php

	require_once "../../models/proyecto.model.php";
        $objProyecto = new Proyecto();

	$objetivo = $_GET["objetivo"];
	$pag = "proyecto-gestion";
	
			$query_tareas = $objProyecto->ConsultarTareas($objetivo);
        	while ($reg_tarea = $query_tareas->fetchObject()) {
        		echo '<tr class="tarea'.$objetivo.'" style="font-size:0.9em">
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