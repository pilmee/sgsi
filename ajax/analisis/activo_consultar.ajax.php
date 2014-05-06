<?php

	require_once "../../models/activo.model.php";
    $objActivo = new Activo();

    $query_activos = $objActivo->ConsultarActivos();

    $i = 1;
    while($reg = $query_activos->fetchObject()){
    	echo "<tr><td>$i</td><td><a href='#' onclick='activoEditar(".$reg->idactivo."); return false;'>".$reg->activo."</a></td><td class='center'>".$reg->uds."</td><td class='center'>".$reg->categoria."</td><td>".$reg->propietario."</td><td class='center' style='background:".$reg->colorconfidencialidad."'>".$reg->confidencialidad."</td><td class='center' style='background:".$reg->colorintegridad."'>".$reg->integridad."</td><td class='center' style='background:".$reg->colordisponibilidad."'>".$reg->disponibilidad."</td><td class='center' style='background:".$reg->colorimportancia."'>".$reg->importancia."</td><td class='center'><input type='checkbox' value='".$reg->idactivo."' /></td><td class='center'><a href='#' onclick='activoEditar(".$reg->idactivo.")'><span class='glyphicon glyphicon-edit'></span></a></td></tr>";
    	$i++;
    }