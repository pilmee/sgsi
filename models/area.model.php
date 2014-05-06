<?php
    require_once "database.model.php";
    
    class Area {
        
        private $conexion;
        
        public function __construct(){
            $this->conexion = new Database();
        }
        
        public function ConsultarAreas($empresa){
            $sql = "SELECT area.nombre, area.idarea FROM public.departamento, public.empresa, public.sucursal, public.area WHERE departamento.iddepartamento = area.iddepartamento AND empresa.idempresa = sucursal.idempresa AND sucursal.idsucursal = departamento.idsucursal AND empresa.idempresa = $empresa";
            $query = $this->conexion->query($sql);
            return $query;
        }
    }
    
?>