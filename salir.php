<?php
    require_once "conf/conf.ini.php";
    //SALIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIR
    session_destroy();
    
    unset($_SESSION["login"]);
  	session_start();
    header("location: index");
?>