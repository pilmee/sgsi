<?php
	require_once "../../models/gap.model.php";
        $objGap = new Gap();
    $query_dominios = $objGap->ConsultarDominios();
    //var_dump($query_dominios);
    echo '<option value="0" selected> Seleccione un control</option>';
		while ($reg = $query_dominios->fetchObject()) {            
    		echo '<optgroup label="'.$reg->indice.' - '.$reg->detalle.'">';
    		
    		$query_objetivos = $objGap->ConsultarObjetivos($reg->id);
    		while ($reg_objetivos = $query_objetivos->fetchObject()) {
    			echo '<optgroup label="'.$reg_objetivos->indice.' - '.$reg_objetivos->detalle.'">';

    			$query_controles = $objGap->ConsultarControles($reg_objetivos->id);
    			while ($reg_controles = $query_controles->fetchObject()) {
                    echo '<option value="'.$reg_controles->id.'">'.$reg_controles->indice.' - '.$reg_controles->detalle.'</option>';
                }
                echo '</optgroup>';
    				
    		}

            echo '</optgroup>';
    	}    	