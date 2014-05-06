
<?php

	require_once "../../models/gap.model.php";
        $objGap = new Gap();

    $dominio = $_POST["dominio"];

    		$query_objetivos = $objGap->ConsultarObjetivos($dominio);
    		while ($reg_objetivos = $query_objetivos->fetchObject()) {
    			echo '<tr class="warning objetivo dom'.$dominio.'"><td></td><td>'.$reg_objetivos->indice.'</td><td>'.$reg_objetivos->detalle.'</td><td></td><td></td><td></td></tr>';

    			$query_controles = $objGap->ConsultarControles($reg_objetivos->id);
    			while ($reg_controles = $query_controles->fetchObject()) {
    				$aplica = "";
	    			$no_aplica = "";
	    			$no_implementado = "";
	    			$parcialmente_implementado = "";
	    			$implementado = "";
	    			$nodefinido_aplica  = "";
	    			$nodefinido_implementado ="";

    				if($reg_controles->aplica==2 ){ $aplica = " selected"; }elseif($reg_controles->aplica == 1){ $no_aplica = " selected"; }else{ $nodefinido_aplica = " selected"; }
    				if($reg_controles->estado==1){ $no_implementado = " selected"; }elseif ($reg_controles->estado==2) { $parcialmente_implementado = " selected"; }elseif ($reg_controles->estado == 3) { $implementado = " selected"; } else{ $nodefinido_implementado = " selected"; }

    				echo '<tr class="control dom'.$dominio.'"><td></td><td>'.$reg_controles->indice.'</td><td>'.$reg_controles->detalle.'</td><td><select data-control="'.$reg_controles->id.'" class="form-control input-sm control-aplica"><option value="0" '.$nodefinido_aplica.'>No definido</option><option value="1" '.$no_aplica.'>No aplica</option><option value="2"  '.$aplica.'>Aplica</option></select></td><td><select class="form-control input-sm control-implementar" data-control="'.$reg_controles->id.'"><option value="0" '.$nodefinido_implementado.'>No definido</option><option value="1"  '.$no_implementado.'>No implementado</option><option value="2" '.$parcialmente_implementado.'>Parcialmente implementado</option><option value="3" '.$implementado.'>Implementado</option></select></td><td><input type="text"  class="form-control input-sm control-observacion" data-control="'.$reg_controles->id.'" value="'.$reg_controles->observacion.'" placeholder="Sin observacion" /></td></tr>';
    			}
    		}
?>
<script>
$("select.control-aplica").change(function(){
    	var control = $(this).attr('data-control');
    	var value = $(this).val();
        $.post("./ajax/inicio/analisis_gap_actualizar_control.ajax.php", { opcion: 'aplica', control: control, valor: value }, function(r){
        	console.log(r);
        	//AnalisisGapConsultar(true);
        });
    });
    $("select.control-implementar").change(function(){
    	var control = $(this).attr('data-control');
    	var value = $(this).val();
    	$.post("./ajax/inicio/analisis_gap_actualizar_control.ajax.php", { opcion: 'implementar', control: control, valor: value }, function(r){
        	console.log(r);
        	//AnalisisGapConsultar(true);
        });
        
    });
    $("input.control-observacion").blur(function(){
    	var control = $(this).attr('data-control');
    	var value = $(this).val();
        $.post("./ajax/inicio/analisis_gap_actualizar_control.ajax.php", { opcion: 'observacion', control: control, valor: value }, function(r){
        	console.log(r);
        	//AnalisisGapConsultar(true);
        });
    });
</script>