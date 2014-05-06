<?php
    require_once "database.model.php";
    
    class Empleado {
        
        private $conexion;
        
        public function __construct(){
            $this->conexion = new Database();
        }
        
        public function AsignarCargo($empleado, $cargo){
            $sw = true;
                $sql = "UPDATE empleado SET idcargo=$cargo WHERE idempleado = $empleado";
                $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        public function EliminarCargo($empleado){
            $sw = true;
                $sql = "UPDATE empleado SET idcargo=NULL WHERE idempleado = $empleado";
                //var_dump($sql);
                $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        public function ConsultarEmpleadoSegunCargo($cargo){
            $sql = "SELECT empleado.idempleado, empleado.nombres, empleado.apellidos, empleado.dni, cargo.nombre, empresa.idempresa, cargo.idcargo FROM public.empleado, public.empresa, public.departamento, public.cargo, public.area, public.sucursal WHERE empresa.idempresa = sucursal.idempresa AND departamento.iddepartamento = area.iddepartamento AND cargo.idcargo = empleado.idcargo AND area.idarea = cargo.idarea AND sucursal.idsucursal = departamento.idsucursal AND cargo.idcargo = $cargo";
            $query = $this->conexion->query($sql);
            return $query;
        }
        
        public function ConsultarEmpleados($empresa){
            $sql = "SELECT empleado.idempleado, empleado.nombres, empleado.apellidos, empleado.dni, cargo.nombre, empresa.idempresa FROM public.empleado, public.empresa, public.departamento, public.cargo, public.area, public.sucursal WHERE empresa.idempresa = sucursal.idempresa AND departamento.iddepartamento = area.iddepartamento AND cargo.idcargo = empleado.idcargo AND area.idarea = cargo.idarea AND sucursal.idsucursal = departamento.idsucursal AND empresa.idempresa = $empresa";
            $query = $this->conexion->query($sql);
            return $query;
        }
        
        public function ConsultarEmpleadosSinCargo($empresa){
            $sql = "SELECT empleado.apellidos, empleado.nombres, empleado.idempleado, empresa.idempresa, empleado.idcargo FROM public.empresa, public.empleado WHERE empresa.idempresa = empleado.idempresa AND empleado.idcargo IS NULL AND empresa.idempresa = $empresa";
            $query = $this->conexion->query($sql);
            return $query;
        }
    }
    