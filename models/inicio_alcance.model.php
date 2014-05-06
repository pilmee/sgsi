<?php

    require_once "database.model.php";
    
    class InicioAlcance {
        
        private $conexion;
        
        public function __construct(){
            $this->conexion = new Database();
        }
        
        public function AbrirInicioAlcance($acta){
            $sql = "SELECT inicio_alcance.* FROM public.inicio_alcance, public.acta_reunion WHERE acta_reunion.idacta_reunion = inicio_alcance.idacta_reunion AND acta_reunion.idacta_reunion = $acta";
            $query = $this->conexion->query($sql);
            return $query;
        }
        
        public function RegistrarInicioAlcance($acta, $nombre){
            $sw = true;
                $sql = "INSERT INTO inicio_alcance(idacta_reunion, nombre) VALUES ($acta, '".$nombre."')";
                $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        public function ActualizarInicioAlcance($acta,$nombre,$alcance,$descripcion,$sg,$exclusion,$organigrama,$diagrama){
            $sw = true;
            if(empty($sg)){ $sg="NULL"; }
            $sql = "UPDATE inicio_alcance SET nombre='".$nombre."', alcance='".$alcance."', descripcion='".$descripcion."', idsg=".$sg.", exclusion='".$exclusion."', ubicacion_organigrama='".$organigrama."', ubicacion_diagrama='".$diagrama."' WHERE inicio_alcance.idacta_reunion = $acta";
            //var_dump($sql);
            $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        
        /** SUBIR ARCHIVOS **/
        
        public function EliminarArchivo($tipo, $acta){
            $sw = true;
            $sql = "DELETE FROM $tipo WHERE idacta_reunion = $acta ";
            $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        public function ConsultarArchivo($tipo, $acta){
            $sql = "SELECT * FROM $tipo WHERE idacta_reunion = $acta ";
            $query = $this->conexion->query($sql);
            return $query;
        
        }
        
        public function AgregarArchivo($tipo, $nombre, $extension, $peso = 0, $detalle, $acta){
            $sw = true;
            $sql = "";
                switch($tipo){
                    case 'organigrama':
                                $sql = "INSERT INTO organigrama( extension, archivo, descripcion, idacta_reunion, peso) VALUES ( '".$extension."', '".$nombre."', '".$detalle."', $acta, '".$peso."')";
                        break;
                    case 'diagrama':
                                $sql = "INSERT INTO diagrama(extension, archivo, descripcion, idacta_reunion, peso) VALUES ('".$extension."', '".$nombre."', '".$detalle."', $acta, '".$peso."')";
                        break;
                }
            $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        
        /** DETALLES **/
        
        public function AgregarInterface($acta, $cargo){
            $sw = true;
            $sql = "INSERT INTO interfaces(idinicio_alcance, idcargo) VALUES ($acta, $cargo)";
            //var_dump($sql);
            $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        public function ConsultarInterfaces($acta){
            $sql = "SELECT cargo.nombre, cargo.idcargo, inicio_alcance.idacta_reunion FROM public.inicio_alcance, public.interfaces, public.cargo WHERE inicio_alcance.idacta_reunion = interfaces.idinicio_alcance AND cargo.idcargo = interfaces.idcargo AND inicio_alcance.idacta_reunion = $acta";
            //var_dump($sql);
            $query = $this->conexion->query($sql);
            return $query;
        }
        
        public function EliminarInterface($acta, $cargo){
            $sw = true;
                $sql = "DELETE FROM interfaces WHERE idinicio_alcance = $acta AND idcargo = $cargo";
                $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        
        public function AgregarLocalizacionFisica($acta, $area){
            $sw = true;
            $sql = "INSERT INTO localizacion_fisica(idinicio_alcance, idarea) VALUES ($acta, $area)";
            //var_dump($sql);
            $this->conexion->query($sql) or $sw = false;
            return $sw; 
        }
        public function ConsultarLocalizacionFisica($acta){
            $sql = "SELECT inicio_alcance.idacta_reunion, area.nombre, area.idarea FROM public.area, public.localizacion_fisica, public.inicio_alcance WHERE area.idarea = localizacion_fisica.idarea AND inicio_alcance.idacta_reunion = localizacion_fisica.idinicio_alcance AND inicio_alcance.idacta_reunion = $acta";
            //var_dump($sql);
            $query = $this->conexion->query($sql);
            return $query;
        }
        
        public function EliminarLocalizacionFisica($acta, $area){
            $sw = true;
                $sql = "DELETE FROM localizacion_fisica WHERE idinicio_alcance = $acta AND idarea = $area";
                $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        
        public function AgregarDepartamento($acta, $departamento){
            $sw = true;
            $sql = "INSERT INTO departamentos(idinicio_alcance, iddepartamento) VALUES ($acta, $departamento)";
            //var_dump($sql);
            $this->conexion->query($sql) or $sw = false;
            return $sw; 
        }
        public function ConsultarDepartamentos($acta){
            $sql = "SELECT departamento.nombre, departamento.iddepartamento, inicio_alcance.idacta_reunion FROM public.departamentos, public.inicio_alcance, public.departamento WHERE inicio_alcance.idacta_reunion = departamentos.idinicio_alcance AND departamento.iddepartamento = departamentos.iddepartamento AND inicio_alcance.idacta_reunion = $acta";
            //var_dump($sql);
            $query = $this->conexion->query($sql);
            return $query;
        }
        
        public function EliminarDepartamento($acta, $departamento){
            $sw = true;
                $sql = "DELETE FROM departamentos WHERE idinicio_alcance = $acta AND iddepartamento = $departamento";
                $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        
        
        public function AgregarResponsable($acta, $empleado){
            $sw = true;
            $sql = "INSERT INTO responsables(idinicio_alcance, idempleado) VALUES ($acta, $empleado)";
            //var_dump($sql);
            $this->conexion->query($sql) or $sw = false;
            return $sw; 
        }
        public function ConsultarResponsables($acta){
            $sql = "SELECT empleado.nombres, empleado.apellidos, empleado.dni, inicio_alcance.idacta_reunion, empleado.idempleado FROM public.empleado, public.responsables, public.inicio_alcance WHERE empleado.idempleado = responsables.idempleado AND inicio_alcance.idacta_reunion = responsables.idinicio_alcance AND inicio_alcance.idacta_reunion = $acta";
            //var_dump($sql);
            $query = $this->conexion->query($sql);
            return $query;
        }
        
        public function EliminarResponsable($acta, $empleado){
            $sw = true;
                $sql = "DELETE FROM responsables WHERE idinicio_alcance = $acta AND idempleado = $empleado";
                $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        
        public function AgregarComite($acta, $cargo){
            $sw = true;
            $sql = "INSERT INTO comite(idinicio_alcance, idcargo) VALUES ($acta, $cargo)";
            //var_dump($sql);
            $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        public function ConsultarComite($acta){
            $sql = "SELECT cargo.idcargo, comite.idinicio_alcance, cargo.nombre FROM public.inicio_alcance, public.cargo, public.comite WHERE inicio_alcance.idacta_reunion = comite.idinicio_alcance AND cargo.idcargo = comite.idcargo AND inicio_alcance.idacta_reunion = $acta";
            //var_dump($sql);
            $query = $this->conexion->query($sql);
            return $query;
        }
        
        public function EliminarComite($acta, $cargo){
            $sw = true;
                $sql = "DELETE FROM comite WHERE idinicio_alcance = $acta AND idcargo = $cargo";
                $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
    }
    