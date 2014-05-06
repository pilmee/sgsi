<?php
    require_once "database.model.php";
    
    class Objetivo {
        private $conexion;
        
        public function __construct(){
            $this->conexion = new Database();
        }
        
        public function NuevoObjetivo($acta, $objetivo, $descripcion, $empleado_responsable){
            $sw = true;
                $sql = "INSERT INTO objetivo(idacta_reunion, objetivo, descripcion, idempleado) VALUES ($acta, '".$objetivo."', '".$descripcion."', $empleado_responsable)";
                var_dump($sql);
                $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        public function AbrirObjetivo($objetivo){
            $sql = "SELECT * FROM objetivo WHERE idobjetivo = $objetivo";
            $query = $this->conexion->query($sql);
            return $query;
        }
        
        public function ActualizarObjetivo($idobjetivo, $objetivo, $descripcion, $empleado_responsable){
            $sw = true;
            if(empty($empleado_responsable)){ $empleado_responsable = "NULL"; }
                $sql = "UPDATE objetivo SET objetivo='".$objetivo."', descripcion='".$descripcion."', idempleado=".$empleado_responsable." WHERE idobjetivo = $idobjetivo";
                //var_dump($sql);
            $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        public function EliminarObjetivo($objetivo){
            $sw = true;
                $sql = "DELETE FROM objetivo WHERE idobjetivo = $objetivo";
                $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        public function ConsultarObjetivos($acta){
            $sql=  "SELECT * FROM objetivo WHERE idacta_reunion = $acta";
            $query = $this->conexion->query($sql);
            return $query;
        }
        
        /***  DETALLES  ***/
        public function AgregarDocumento($objetivo, $documento, $extension, $peso, $descripcion){
            $sw = true;
                $sql= "INSERT INTO objetivo_documentos(idobjetivo, documento, extension, descripcion, peso) VALUES ($objetivo, '".$documento."', '".$extension."', '".$descripcion."', '".$peso."')";
                $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        public function ConsultarDocumentos($objetivo){
            $sql = "SELECT idobjetivo_documentos, idobjetivo, documento, extension, fecha, descripcion, peso FROM objetivo_documentos WHERE idobjetivo = $objetivo";
            $query = $this->conexion->query($sql);
            return $query;
        }
        public function EliminarDocumento($objetivo_doc){
            $sw = true;
                $sql = "DELETE FROM objetivo_documentos WHERE idobjetivo_documentos=$objetivo_doc";
                $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        
        public function AgregarObjetivoEspecifico($objetivo,$descripcion,$empleado,$recursos){
            $sw = true;
            if(empty($empleado)){ $empleado = "NULL"; }
                $sql = "INSERT INTO objetivo_especifico(idobjetivo, descripcion, idempleado, recursos) VALUES ($objetivo, '".$descripcion."', $empleado, '".$recursos."')";
                $this->conexion->query($sql) or $sw =false;
            return $sw;
        }
        public function ConsultarObjetivoEspecifico($objetivo){
            $sql = "SELECT objetivo_especifico.nombre AS objetivo_nombre, objetivo_especifico.descripcion, empleado.apellidos,empleado.nombres, objetivo_especifico.recursos,objetivo.idobjetivo,objetivo_especifico.idobjetivo_especifico FROM public.objetivo INNER JOIN public.objetivo_especifico ON objetivo.idobjetivo = objetivo_especifico.idobjetivo LEFT JOIN  public.empleado ON public.objetivo_especifico.idempleado = empleado.idempleado WHERE  objetivo.idobjetivo = $objetivo;";
            $query = $this->conexion->query($sql);
            return $query;
        }
        public function EliminarObjetivoEspecifico($objetivo){
            $sw = true;
                $sql = "DELETE FROM objetivo_especifico WHERE objetivo_especifico.idobjetivo_especifico = $objetivo";
                $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        
        public function AgregarAreaAfectada($objetivo, $area){
            $sw = true;
                $sql = "INSERT INTO objetivo_area_afectada(idobjetivo, idarea)VALUES ($objetivo, $area)";
                $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        public function ConsultarAreaAfectada($objetivo){
            $sql = "SELECT area.nombre, objetivo_area_afectada.idobjetivo, area.idarea FROM public.area, public.objetivo, public.objetivo_area_afectada WHERE area.idarea = objetivo_area_afectada.idarea AND objetivo.idobjetivo = objetivo_area_afectada.idobjetivo AND objetivo.idobjetivo = $objetivo";
            $query = $this->conexion->query($sql);
            return $query;
        }
        
        public function EliminarAreaAfectada($objetivo, $area){
            $sw=true;
                $sql = "DELETE FROM objetivo_area_afectada WHERE idobjetivo = $objetivo AND idarea = $area";
                var_dump($sql);
                $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
    }
    