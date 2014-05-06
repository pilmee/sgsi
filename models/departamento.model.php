<?php

    require_once "database.model.php";
    
    class Departamento {
        
        private $conexion;
        
        public function __construct(){
            $this->conexion = new Database();
        }
        
        public function ConsultarDepartamentos($empresa){
            $sql = "SELECT empresa.idempresa, departamento.iddepartamento, departamento.nombre FROM public.empresa, public.sucursal, public.departamento WHERE empresa.idempresa = sucursal.idempresa AND sucursal.idsucursal = departamento.idsucursal AND empresa.idempresa = $empresa";
            $query = $this->conexion->query($sql);
            return $query;
        }
    }
    