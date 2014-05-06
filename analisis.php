<?php
	$html = 3;

	require_once "conf/conf.ini.php";
    if(!isset($_SESSION["login"]) || !$_SESSION["login"]){
        $pag_title = "Ingreso al sistema";
        include_once "views/login.view.phtml";
    }else{

    	/*** PAGINA DEPENDENCIAS ***/
    	require_once "./models/activo.model.php";
    		$objActivo = new Activo();
    	require_once "./models/amenaza.model.php";
    		$objAmenaza = new Amenaza();
    	require_once "./models/empleado.model.php";
    		$objEmpleado = new Empleado();
	require_once "./models/indicador.model.php";
    		$objIndicador = new Indicador();

    	/*** PAGINA VISTA PRINCIPAL ***/
    	$pag_title = "Analisis";
    	include_once "./views/analisis/analisis.view.phtml";
    }