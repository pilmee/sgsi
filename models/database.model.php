<?php
/** 
*
* @PHP MVC Framework "application/database.php"
* @versión: 0.1      @modificado: 10 de Septiembre del 2013
* @autor: PiLMee GaTes (@pilmee)
* @descripcion: Clase Database que hereda de la clase abs PDO.
*
**/

 define("DATABASE_DRIVER","pgsql");
    define("DATABASE_HOST","localhost");
    define("DATABASE_NAME","sgsi");
    define("DATABASE_USER","postgres");
    define("DATABASE_PASSWORD","pilmee");

class Database extends PDO{

    public function __construct(){
	parent::__construct(DATABASE_DRIVER.":host=".DATABASE_HOST.";dbname=".DATABASE_NAME, DATABASE_USER, DATABASE_PASSWORD);
    }
    
}