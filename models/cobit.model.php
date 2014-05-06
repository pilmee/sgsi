<?php
    require_once "database.model.php";
    
    class Cobit {
        
        private $conexion;
        
        public function __construct(){
            $this->conexion = new Database();
        }
        
        public function Consultar($contraido = true){
            $sql = "";
            if($contraido){
                $sql= "";
            }else{
                $sql = "";
            }
            $query = $this->conexion->query($sql);
            return $query;
        }
    }
    