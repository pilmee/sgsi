<?php

  	$id = strip_tags(trim($_POST["txtIdSuministrador"]));
  	$ruc = strip_tags(trim($_POST["txtRuc"]));
  	$razonSocial = strip_tags(trim($_POST["txtRazonSocial"]));
  	$responsable = strip_tags(trim($_POST["cboResponsable"]));
  	$direccion = strip_tags(trim($_POST["txtDireccion"]));
  	$poblacion = strip_tags(trim($_POST["txtPoblacion"]));
  	$provincia = strip_tags(trim($_POST["txtProvincia"]));
  	$pais = strip_tags(trim($_POST["txtPais"]));
  	$descripcion = strip_tags(trim($_POST["txtDescripcion"]));
  	$estado = strip_tags(trim($_POST["cboEstado"]));
  	$comentario = strip_tags(trim($_POST["txtComentario"]));
  	$indicadorAsociado = strip_tags(trim($_POST["cboIndicadorAsociado"]));

    
     require_once "../../models/suministrador.model.php";
        $objSuministrador = new Suministrador();
    
    if(!$objSuministrador->ActualizarSuministrador($id,$ruc,$razonSocial,$responsable,$direccion,$poblacion,$provincia,$pais,$descripcion,$estado,$comentario,$indicadorAsociado)){
        echo "La informacion del Suministrador no ha podido ser actualizada.";
    }else{
        echo "Se actualializo la informacion del suministrador.";
    }