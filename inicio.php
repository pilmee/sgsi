<?php
    $html = 2;

    require_once "conf/conf.ini.php";
    if(!isset($_SESSION["login"]) || !$_SESSION["login"]){
        $pag_title = "Ingreso al sistema";
        include_once "views/login.view.phtml";
    }else{
        require_once "./models/acta_reunion.model.php";
            $objActaReunion = new Acta_Reunion();
            
        require_once "./models/sg.model.php";
            $objSG = new SG();
        
        require_once "./models/cargo.model.php";
            $objCargo = new Cargo();
            
        require_once "./models/inicio_alcance.model.php";
            $objInicioAlcance = new InicioAlcance();
        
        require_once "./models/empleado.model.php";
            $objEmpleado = new Empleado();
        
        require_once "./models/departamento.model.php";
            $objDepartamento = new Departamento();
            
        require_once "./models/area.model.php";
            $objArea = new Area();
            
        require_once "./models/objetivo.model.php";
            $objObjetivo = new Objetivo();
        
        require_once "./models/suministrador.model.php";
            $objSuministrador = new Suministrador();  
        
        require_once "./models/gap.model.php";
            $objGap = new Gap();  

        require_once "./models/proyecto.model.php";
            $objProyecto = new Proyecto(); 
            
        
        $pag_title = "Inicio";
        include_once "./views/inicio/inicio.view.phtml";
        
        
    }
    