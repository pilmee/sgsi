<?php
    require_once "database.model.php";
    
    class Cargo {
        
        private $conexion;
        
        public function __construct(){
            $this->conexion = new Database();
        }
        
        public function AgregarCompetencia($cargo, $competencia){
            $sw = true;
                $sql = "INSERT INTO competencia(idcargo, detalle) VALUES ($cargo, '".$competencia."')";
                $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        public function ConsultarCompetencia($empresa){
            $sql = "SELECT competencia.idcompetencia, competencia.detalle, cargo.nombre, empresa.idempresa FROM public.competencia,   public.cargo,  public.area,   public.departamento,   public.sucursal,   public.empresa WHERE   cargo.idcargo = competencia.idcargo AND  area.idarea = cargo.idarea AND departamento.iddepartamento = area.iddepartamento AND sucursal.idsucursal = departamento.idsucursal AND empresa.idempresa = sucursal.idempresa AND empresa.idempresa = $empresa";
            $query = $this->conexion->query($sql);
            return $query;
        }
        public function EliminarCompetencia($competencia){
            $sw = true;
                $sql = "DELETE FROM competencia  WHERE competencia.idcompetencia = $competencia";
                $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        public function AgregarObligacion($cargo, $obligacion){
            $sw = true;
                $sql = "INSERT INTO obligacion(idcargo, detalle) VALUES ($cargo, '".$obligacion."')";
                $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        public function ConsultarObligacion($empresa){
            $sql = "SELECT obligacion.idobligacion, cargo.nombre,   empresa.idempresa,   obligacion.detalle FROM   public.cargo,  public.area,   public.departamento,   public.sucursal,  public.empresa,   public.obligacion WHERE   cargo.idcargo = obligacion.idcargo AND  area.idarea = cargo.idarea AND  departamento.iddepartamento = area.iddepartamento AND  sucursal.idsucursal = departamento.idsucursal AND  empresa.idempresa = sucursal.idempresa AND empresa.idempresa = $empresa";
            $query = $this->conexion->query($sql);
            return $query;
        }
        public function EliminarObligacion($obligacion){
            $sw = true;
                $sql = "DELETE FROM obligacion WHERE obligacion.idobligacion = $obligacion";
                $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        public function ConsultarCargos($empresa){
            $sql = "SELECT cargo.idcargo, cargo.idarea, cargo.nombre FROM public.cargo, public.area, public.departamento, public.sucursal, public.empresa WHERE area.idarea = cargo.idarea AND departamento.iddepartamento = area.iddepartamento AND sucursal.idsucursal = departamento.idsucursal AND empresa.idempresa = sucursal.idempresa AND empresa.idempresa = $empresa";
            $query = $this->conexion->query($sql);
            return $query;
        }
    }
    
?>