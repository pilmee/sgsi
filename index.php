<?php
    $html = 1;

    require_once "conf/conf.ini.php";
    if(!isset($_SESSION["login"]) || !$_SESSION["login"]){
        $pag_title = "Ingreso al sistema";
        include_once "views/login.view.phtml";
    }else{
        require_once "./models/acta_reunion.model.php";
            $objActaReunion = new Acta_Reunion();
        
        require_once "./models/empleado.model.php";
            $objEmpleado = new Empleado();
        
        $pag_title = "Gestion de Actas";
        include_once "./views/home/home.view.phtml";
    }
    