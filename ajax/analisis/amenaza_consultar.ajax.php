<?php

	require_once "../../models/amenaza.model.php";
    $objAmenaza = new Amenaza();

    $activo = $_GET["activo"];
    $query = $objAmenaza->ConsultarAmenazasSegunActivo($activo);

    $i = 1;
    while($reg = $query->fetchObject()){
    	echo '<tr><td><input type="checkbox" name="chkAmenaza" id="chkAmenaza'.$i.'" value="'.$reg->idamenaza.'" /></td><td>'.$i.'</td><td>'.$reg->amenaza.'</td><td>'.$reg->vulnerabilidad.'</td><td>'.$reg->comentario.'</td><td class="center" style="background:'.$reg->colorprobabilidad.'">'.$reg->probabilidad.'</td><td  class="center" style="background:'.$reg->colorimpacto.'">'.$reg->impacto.'</td><td class="center" style="background:'.$reg->colorriesgo.'">'.$reg->riesgo.'</td><td style="text-align:right"><span class="glyphicon glyphicon-edit" onclick="cargarInformacionAmenaza('.$reg->idamenaza.',\''.$reg->amenaza.'\',\''.$reg->activo.'\',\''.$reg->vulnerabilidad.'\',\''.$reg->comentario.'\',\''.$reg->idimportancia.'\',\''.$reg->idprobabilidad.'\',\''.$reg->idimpacto.'\',\''.$reg->idriesgo.'\')"></span></td></tr>';
    	$i++;
    }