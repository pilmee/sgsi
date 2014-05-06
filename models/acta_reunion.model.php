<?php
    require_once "database.model.php";
    
    class Acta_Reunion {
        
        private $conexion;
        
        public function __construct(){
            $this->conexion = new Database();
        }
        
        public function ActualizarActa($acta,$asunto,$fecha,$tipoActa,$duracion,$lugar,$descripcion){
            $sw = true;
            $sql = "UPDATE acta_reunion SET idtipo_acta_reunion=$tipoActa, asunto='".$asunto."', duracion='".$duracion."', lugar='".$lugar."', descripcion='".$descripcion."', fecha='".$fecha."' WHERE idacta_reunion = $acta ";
            $query = $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        public function AbrirActa($acta){
            $sql = "select * from acta_reunion AR inner join tipo_acta_reunion TAR on AR.idtipo_acta_reunion = TAR.idtipo_acta_reunion WHERE AR.idacta_reunion = $acta";
            $query = $this->conexion->query($sql);
            return $query;
        }
        
        public function NuevaActaReunion($tipo_acta_reunion, $asunto, $fecha){
            $sw = true;
            $sql = "INSERT INTO acta_reunion( idtipo_acta_reunion, asunto, fecha) VALUES ($tipo_acta_reunion, '".$asunto."', '".$fecha."');";
            $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        public function EliminarActa($acta){
            $sw = true;
            $sql = "delete from acta_reunion where idacta_reunion = $acta";
            $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        public function ConsultarActas(){
            $sql = "select * from acta_reunion AR inner join tipo_acta_reunion TAR on AR.idtipo_acta_reunion = TAR.idtipo_acta_reunion";
            $query = $this->conexion->query($sql);
            return $query;
        }
        
        public function ConsultarTipoActas(){
            $sql = "select * from tipo_acta_reunion";
            $query = $this->conexion->query($sql);
            return $query;
        }
        
        public function getNumActas(){
            $sql = "select count(9) as actas from acta_reunion";
            $query = $this->conexion->query($sql);
            $reg = $query->fetchObject();
            return $reg->actas;
        }
        
        
        /*** DETALLES **/
        
        public function AgregarEmpleado($acta_reunion, $empleado, $responsable_acta = false){
            $sw = true;
            $sql = "INSERT INTO asistentes(idempleado, idacta_reunion, responsable_acta) VALUES ($empleado, $acta_reunion, $responsable_acta);";
            $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        public function ConsultarEmpleados($acta){
            $sql = "SELECT acta_reunion.idacta_reunion, empleado.idempleado, empleado.nombres, empleado.apellidos, cargo.nombre AS cargo, asistentes.responsable_acta FROM public.acta_reunion, public.asistentes, public.empleado,  public.cargo WHERE  acta_reunion.idacta_reunion = asistentes.idacta_reunion AND empleado.idempleado = asistentes.idempleado AND cargo.idcargo = empleado.idcargo and asistentes.idacta_reunion = $acta";
            $query = $this->conexion->query($sql);
            return $query;
        }
        
        public function CambiarResponsabilidadEmpleado($acta, $empleado){
            $sw = true;
            $sql = "select * from asistentes where idempleado = $empleado and idacta_reunion = $acta";
            $query = $this->conexion->query($sql);
            $reg = $query->fetchObject();
            if($reg->responsable_acta){
                $sql_update = "UPDATE asistentes SET responsable_acta=FALSE WHERE idempleado = $empleado and idacta_reunion = $acta";
            }else{
                $sql_update = "UPDATE asistentes SET responsable_acta=TRUE WHERE idempleado = $empleado and idacta_reunion = $acta";
            }
            $this->conexion->query($sql_update) or $sw = false;
            return $sw;
        }
        
        public function EliminarEmpleado($acta, $empleado){
            $sw = true;
            $sql = "DELETE FROM asistentes WHERE idempleado = $empleado AND idacta_reunion = $acta";
            $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        
        public function AgregarPuntoTratado($acta, $actividad, $descripcion){
            $sw = true;
            $sql = "INSERT INTO puntos_tratados(idacta_reunion, actividad, descripcion) VALUES ($acta, '".$actividad."', '".$descripcion."')";
            $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        public function ConsultarPuntosTratados($acta){
            $sql = "select * from puntos_tratados where idacta_reunion = $acta";
            $query = $this->conexion->query($sql);
            return $query;
        }
        
        public function EliminarPuntoTratado($punto){
            $sw = true;
            $sql = "DELETE FROM puntos_tratados where idpuntos_tratados = $punto";
            $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        
        public function AgregarConclusion($acta, $nombre, $descripcion){
            $sw = true;
            $sql = "INSERT INTO conclusiones_acta(idacta_reunion, nombre, descripcion) VALUES ($acta, '".$nombre."', '".$descripcion."')";
            $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        public function ConsultarConclusiones($acta){
            $sql = "select * from conclusiones_acta where idacta_reunion = $acta";
            $query = $this->conexion->query($sql);
            return $query;
        }
        
        public function EliminarConclusion($conclusion){
            $sw = true;
            $sql = "DELETE FROM conclusiones_acta where idconclusiones_acta = $conclusion";
            $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        
        public function AgregarAsuntoPendiente($acta, $accion, $responsable, $plazo){
            $sw = true;
            $sql = "INSERT INTO asuntos_pendientes(idacta_reunion, accion, idempleado, plazo) VALUES ($acta, '".$accion."', '".$responsable."', '".$plazo."')";
            $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        public function ConsultarAsuntosPendientes($acta){
            $sql = "SELECT empleado.apellidos, empleado.nombres, asuntos_pendientes.accion, asuntos_pendientes.plazo, asuntos_pendientes.idasuntos_pendientes FROM public.asuntos_pendientes, public.empleado WHERE empleado.idempleado = asuntos_pendientes.idempleado and asuntos_pendientes.idacta_reunion = $acta";
            $query = $this->conexion->query($sql);
            return $query;
        }
        public function EliminarAsuntoPendiente($asunto){
            $sw = true;
            $sql = "DELETE FROM asuntos_pendientes where idasuntos_pendientes = $asunto";
            $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        
        public function AgregarDocumentacion($acta, $nombre, $entrego, $referencia){
            $sw = true;
            $sql = "INSERT INTO documentacion_acta(idacta_reunion, nombre, entrego, referencia) VALUES ($acta, '".$nombre."', '".$entrego."', '".$referencia."')";
            var_dump($sql);
            $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        public function ConsultarDocumentacion($acta){
            $sql = "SELECT * from documentacion_acta where idacta_reunion = $acta";
            $query = $this->conexion->query($sql);
            return $query;
        }
        public function EliminarDocumentacion($documentacion){
            $sw = true;
            $sql = "DELETE FROM documentacion_acta where iddocumentacion_acta = $documentacion";
            $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
    }
    

?>