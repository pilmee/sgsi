<?php
    require_once "conf/conf.ini.php";
    require_once "models/sistema.model.php";

    if($_POST){
        $usuario = strip_tags(trim($_POST["usuario"]));
        $clave   = md5(strip_tags(trim($_POST["clave"])));

        $objSistema = new Sistema();
        $query = $objSistema->AutenticarUsuario($usuario,$clave);

        if($query->rowCount() > 0){
            $reg = $query->fetchObject();
            if($reg->activo){
                $_SESSION["login"] = true;
                $_SESSION["user"] = "Administrador del Sistema";
                $_SESSION["empresa"] = $reg->idempresa;
                header("location: index.php");
            }else{
                header("location: index.php?login=false");
            }
        }
        
    }
    