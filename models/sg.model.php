<?php
    require_once "database.model.php";
    
    class SG {
        
        private $conexion;
        
        public function __construct(){
            $this->conexion = new Database();
        }
        
        public function ConsultarSG(){
            $sql = "select * from sg";
            $query = $this->conexion->query($sql);
            return $query;
        }
    }
    
?>