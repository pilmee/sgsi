<?php
    require_once "database.model.php";

    class Indicador{
		
        private $coneixon;

        public function __construct(){
            $this->conexion = new Database();
        }
        
        public function  Consultar(){
            $sql = "SELECT idindicador, detalle, estado FROM indicadores";
            $query = $this->conexion->query($sql);
            return $query;
        }
        
    }
    