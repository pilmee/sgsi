<?php
	require_once "../../models/proyecto.model.php";
        $objProyecto = new Proyecto();

	$mostrar = $_REQUEST["mostrar"];
	$ano	 = $_REQUEST["ano"];
	$mes	 = $_REQUEST["mes"];

	$numero_dias = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

	for ($i=1; $i <= $numero_dias; $i++) { 
		echo '<div class="dia-calendario">
					<div class="title">'.$i.'</div>
					<div class="cuerpo">
						<ul>';

					$query_tareas = $objProyecto->ConsultarTareasSegunMesAno($mostrar,$i,$mes,$ano);
					while ($reg = $query_tareas->fetchObject()) {
						echo '<li>'.$reg->detalle.'</li>';
					}
		echo '</ul>
					</div>
			  </div>';
	}

?>