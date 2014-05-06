<?php
	require_once "../../models/activo.model.php";
    $objActivo = new Activo();

    $id = $_POST['txtActivoId'];
    $activo = strip_tags(trim($_POST['txtActivo']));
 	$unidades = strip_tags(trim($_POST['txtUnidades']));
  	$propietario = strip_tags(trim($_POST['txtPropietario']));
  	$categoria = empty($_POST['cboCategoria']) ? 'NULL' : $_POST['cboCategoria'];
  	$confidencialidad = empty($_POST['cboConfidencialidad']) ? 'NULL' : $_POST['cboConfidencialidad'];
  	$integridad = empty($_POST['cboIntegridad']) ? 'NULL' : $_POST['cboIntegridad'];
  	$disponibilidad = empty($_POST['cboDisponibilidad']) ? 'NULL' : $_POST['cboDisponibilidad'];
  	$importancia = empty($_POST['cboImportancia']) ? 'NULL' : $_POST['cboImportancia'];
  	$ubicacion_fisica = strip_tags(trim($_POST['txtUbicacionFisica']));
  	$version = strip_tags(trim($_POST['txtVersion']));
  	$descripcion = strip_tags(trim($_POST['txtDescripcion']));
  	$marca_modelo = strip_tags(trim($_POST['txtMarcaModelo']));
  	$fuente_distribuidor =strip_tags(trim( $_POST['txtFuenteDistribuidor']));

  if($objActivo->GuardarActivo($id, $activo, $unidades, $propietario, $categoria, $confidencialidad, $integridad, $disponibilidad, $importancia, $ubicacion_fisica, $version, $descripcion, $marca_modelo, $fuente_distribuidor)){
  	echo 'La informacion del Activo fue actualizada correctamente.';
  }else{
  	echo 'No se ha podido actualizar la informacion del activo.';
  }