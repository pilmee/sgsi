<?php
    require_once "conf/conf.ini.php";
    //
    session_destroy();
    
    unset($_SESSION["login"]);
  	session_start();
    header("location: index");
?>