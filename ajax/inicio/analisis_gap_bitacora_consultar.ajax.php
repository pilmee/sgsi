<?php
	require_once "../../models/gap.model.php";
        $objGap = new Gap();
    $control = $_GET["control"];
    $query_cotroles = $objGap->ConsultarBitacoraGap($control);
    $i = 1;

    if($query_cotroles->rowCount() > 0){
	    while ($reg = $query_cotroles->fetchObject()) {
	    	echo '<tr>';
	    	echo '<td>'.$i.'</td><td>'.$reg->indice.'</td><td>'.$reg->detalle.'</td><td>'.$reg->campo.'</td><td>'.$reg->anterior.'</td><td>'.$reg->actual.'</td><td>'.$reg->fecha.'</td>';
	    	echo '</tr>';
	    	$i++;
	    }
	}else{
		echo '<tr><td colspan="7"><span class="alert alert-info" style="display:block;margin-top:1em; text-align:Center;">No se ha encontrado ningun historial de cambio asignado a este control. Es posible que aun no haya sido modificado o no haya sido cambiado su valor inicial.</span></td></tr>';
	}
