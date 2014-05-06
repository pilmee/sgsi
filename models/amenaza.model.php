<?php
	require_once "database.model.php";

	class Amenaza{
		
		private $coneixon;

		public function __construct(){
            $this->conexion = new Database();
        }

        public function NuevaAmenaza($activo, $amenaza, $fecha){
        	$sw = true;	
        	$sql = "INSERT INTO amenaza(idactivo, amenaza) VALUES ($activo, '".$amenaza."')";
        	$this->conexion->query($sql) or $sw = false;
        	return $sw;
        }

        public function EliminarAmenaza($amenaza){
        	$sw = true;
        	$sql = "DELETE FROM amenaza WHERE idamenaza = $amenaza";
        	$this->conexion->query($sql) or $sw = false;
        	return $sw;
        }

        public function ConsultarAmenazas(){
        	$sql = "SELECT 	AC.activo, A.idamenaza, A.amenaza, A.vulnerabilidad, A.comentario,
        					AIO.idamenaza_impacto AS idimpacto, AIO.detalle AS impacto, AIO.color AS colorimpacto,
        					AIA.idamenaza_importancia AS idimportancia, AIA.detalle as importancia, AIA.color AS colorimportancia,
        					AP.idamenaza_probabilidad AS idprobabilidad, AP.detalle as probabilidad, AP.color AS colorprobabilidad,
        					AR.idamenaza_riesgo AS idriesgo, AR.detalle AS riesgo, AR.color AS colorriesgo
        				FROM amenaza A
        					INNER JOIN activo AC ON A.idactivo = AC.idactivo
        					LEFT JOIN amenaza_impacto AIO ON A.idamenaza_impacto = AIO.idamenaza_impacto
        					LEFT JOIN amenaza_importancia AIA ON A.idamenaza_importancia = AIA.idamenaza_importancia
        					LEFT JOIN amenaza_probabilidad AP ON A.idamenaza_probabilidad = AP.idamenaza_probabilidad
        					LEFT JOIN amenaza_riesgo AR ON A.idamenaza_riesgo = AR.idamenaza_riesgo";
        	$query = $this->conexion->query($sql);
        	return $query;
        }

        public function ConsultarAmenazasSegunActivo($activo){
            $sql = "SELECT  AC.activo, A.idamenaza, A.amenaza, A.vulnerabilidad, A.comentario,
                            AIO.idamenaza_impacto AS idimpacto, AIO.detalle AS impacto, AIO.color AS colorimpacto,
                            AIA.idamenaza_importancia AS idimportancia, AIA.detalle as importancia, AIA.color AS colorimportancia,
                            AP.idamenaza_probabilidad AS idprobabilidad, AP.detalle as probabilidad, AP.color AS colorprobabilidad,
                            AR.idamenaza_riesgo AS idriesgo, AR.detalle AS riesgo, AR.color AS colorriesgo
                        FROM amenaza A
                            INNER JOIN activo AC ON A.idactivo = AC.idactivo
                            LEFT JOIN amenaza_impacto AIO ON A.idamenaza_impacto = AIO.idamenaza_impacto
                            LEFT JOIN amenaza_importancia AIA ON A.idamenaza_importancia = AIA.idamenaza_importancia
                            LEFT JOIN amenaza_probabilidad AP ON A.idamenaza_probabilidad = AP.idamenaza_probabilidad
                            LEFT JOIN amenaza_riesgo AR ON A.idamenaza_riesgo = AR.idamenaza_riesgo
                        WHERE AC.idactivo = $activo";
            $query = $this->conexion->query($sql);
            return $query;
        }


        /*** CONTROLES ***/
        public function NuevoControl($amenaza, $detalle, $fi, $ff, $costo, $responsable){
        	$sw = true;
        	$sql = "INSERT INTO control(idamenaza, \"fechaInicio\", \"fechaFin\", costo, idempleado, control) VALUES ($amenaza, '".$fi."', '".$ff."', '".$costo."', ".$responsable.", '".$detalle."')";
        	var_dump($sql);
        	$this->conexion->query($sql) or $sw = false;
        	return $sw;
        }

        public function EliminarControl($control){
        	$sw = true;
        	$sql = "DELETE FROM control WHERE idcontrol = $control";
        	$this->conexion->query($sql) or $sw = false;
        	return $sw;
        }

        /*** FUNCIONES PARA "EVALUACION DE RIESOS" ***/

        public function ContarAmenazasDeActivoSegunNRA($nra){
            $sql = "";
            switch($nra){
                case 0:
                    $sql = "SELECT COUNT(*) AS total FROM amenaza WHERE idamenaza_impacto IS NULL OR idamenaza_importancia IS NULL OR idamenaza_probabilidad IS NULL ";
                    break;
                case 1:
                    $sql = "SELECT COUNT(*) AS total FROM amenaza WHERE idamenaza_impacto IS NOT NULL AND idamenaza_importancia IS NOT NULL AND idamenaza_probabilidad IS NOT NULL AND  ((idamenaza_impacto+idamenaza_importancia+idamenaza_probabilidad)/3) >= 4";
                    break;
                case 2:
                    $sql = "SELECT COUNT(*) AS total FROM amenaza WHERE idamenaza_impacto IS NOT NULL AND idamenaza_importancia IS NOT NULL AND idamenaza_probabilidad IS NOT NULL AND  ((idamenaza_impacto+idamenaza_importancia+idamenaza_probabilidad)/3) < 4";
                    break;
            }
            $query = $this->conexion->query($sql);
            $fetch = $query->fetchObject();
            return $fetch->total;
        }

        public function ContarAmenazasDeActivo($riesgo_nivel){
            $sql = "SELECT COUNT(*) AS total FROM amenaza WHERE idamenaza_riesgo";
            if($riesgo_nivel < 1){
                $sql .= "  IS NULL";
            }else{
                $sql .= " = $riesgo_nivel";
            }
            $query = $this->conexion->query($sql);
            $fetch = $query->fetchObject();
            return $fetch->total;
        }

        public function ConsultarAmenazasAnalizadas($riesgo_minimo = 4){
            $sql = "SELECT AM.idamenaza,AC.activo, AM.vulnerabilidad, ( (idamenaza_impacto+idamenaza_importancia+idamenaza_probabilidad)/3) as nra, AR.detalle, AR.color AS colorriesgo FROM amenaza AM 
                        INNER JOIN activo AC ON AM.idactivo = AC.idactivo
                        INNER JOIN amenaza_riesgo AR ON AM.idamenaza_riesgo = AR.idamenaza_riesgo
                    WHERE AM.idamenaza_riesgo >= $riesgo_minimo";
            $query = $this->conexion->query($sql);
            return $query;
        }

        /*** FUNCIONES PARA GESTION DE RIESGOS ***/

        public function ConsultarAmenazasSegunActivoyRiesgo($activo, $riesgo_minimo = 4){
            $sql = "SELECT AM.idamenaza,AM.amenaza, AM.vulnerabilidad, ( (idamenaza_impacto+idamenaza_importancia+idamenaza_probabilidad)/3) as nra, AR.detalle, AR.color AS colorriesgo, (SELECT COUNT(*) FROM control CO WHERE CO.idamenaza = AM.idamenaza) as numerocontroles 
                        FROM amenaza AM 
                            INNER JOIN activo AC ON AM.idactivo = AC.idactivo
                            INNER JOIN amenaza_riesgo AR ON AM.idamenaza_riesgo = AR.idamenaza_riesgo
                    WHERE AC.idactivo = $activo AND AM.idamenaza_riesgo >= $riesgo_minimo";
            $query = $this->conexion->query($sql);
            return $query;
        }

        public function ConsultarAmenazasSegunActivoyNRA($activo, $riesgo_minimo = 4, $nra = 4){
            $sql = "SELECT AM.idamenaza,AM.amenaza, AM.vulnerabilidad, ( (idamenaza_impacto+idamenaza_importancia+idamenaza_probabilidad)/3) as nra, AR.detalle, AR.color AS colorriesgo, (SELECT COUNT(*) FROM control CO WHERE CO.idamenaza = AM.idamenaza) as numerocontroles 
                        FROM amenaza AM 
                            INNER JOIN activo AC ON AM.idactivo = AC.idactivo
                            INNER JOIN amenaza_riesgo AR ON AM.idamenaza_riesgo = AR.idamenaza_riesgo
                    WHERE AC.idactivo = $activo AND AM.idamenaza_riesgo >= $riesgo_minimo AND (idamenaza_impacto+idamenaza_importancia+idamenaza_probabilidad)/3 >= $nra";
            $query = $this->conexion->query($sql);
            return $query;
        }

        public function ConsultarAmenazasSegunActivoySinControles($activo, $riesgo_minimo = 4, $nra = 4){
            $sql = "SELECT AM.idamenaza,AM.amenaza, AM.vulnerabilidad, ( (idamenaza_impacto+idamenaza_importancia+idamenaza_probabilidad)/3) as nra, AR.detalle, AR.color AS colorriesgo, (SELECT COUNT(*) FROM control CO WHERE CO.idamenaza = AM.idamenaza) as numerocontroles 
                        FROM amenaza AM 
                            INNER JOIN activo AC ON AM.idactivo = AC.idactivo
                            INNER JOIN amenaza_riesgo AR ON AM.idamenaza_riesgo = AR.idamenaza_riesgo
                            LEFT JOIN control C ON AM.idamenaza = C.idamenaza
                    WHERE AC.idactivo = $activo AND AM.idamenaza_riesgo >= $riesgo_minimo  AND (SELECT COUNT(*) FROM control CO WHERE CO.idamenaza = AM.idamenaza) = 0";
            echo ($sql);
            $query = $this->conexion->query($sql);
            return $query;
        }

        public function ConsultarAmenazasSegunActivoySinControlesyNRA($activo, $riesgo_minimo = 4, $nra = 4){
            $sql = "SELECT AM.idamenaza,AM.amenaza, AM.vulnerabilidad, ( (idamenaza_impacto+idamenaza_importancia+idamenaza_probabilidad)/3) as nra, AR.detalle, AR.color AS colorriesgo, (SELECT COUNT(*) FROM control CO WHERE CO.idamenaza = AM.idamenaza) as numerocontroles 
                        FROM amenaza AM 
                            INNER JOIN activo AC ON AM.idactivo = AC.idactivo
                            INNER JOIN amenaza_riesgo AR ON AM.idamenaza_riesgo = AR.idamenaza_riesgo
                            LEFT JOIN control C ON AM.idamenaza = C.idamenaza
                    WHERE AC.idactivo = $activo AND AM.idamenaza_riesgo >= $riesgo_minimo AND (idamenaza_impacto+idamenaza_importancia+idamenaza_probabilidad)/3 >= $nra  AND (SELECT COUNT(*) FROM control CO WHERE CO.idamenaza = AM.idamenaza) = 0";
            echo ($sql);
            $query = $this->conexion->query($sql);
            return $query;
        }
        
		/*** DETALLES ***/

        public function CalificaRiesgo($nivel){
            $texto = "";
            $color = "";
            switch ($nivel) {
                case 1:
                    $texto = "Muy Bajo";
                    $color = "rgb(144, 225, 101);";
                    break;
                case 2:
                    $texto = "Bajo";
                    $color = "rgb(223, 246, 149);";
                    break;
                case 3:
                    $texto = "Medio";
                    $color = "rgb(250, 212, 145);";
                    break;
                case 4:
                    $texto = "Alto";
                    $color = "rgb(250, 168, 123);";
                    break;
                case 5:
                    $texto = "Muy Alto";
                    $color = "rgb(230, 109, 116);";
                    break;

                default:
                    $texto = "Muy Bajo";
                    $color = "rgb(144, 225, 101);";
                    break;
            }
            $resultado = array();
            $resultado["texto"] = $texto;
            $resultado["color"] = $color;

            return $resultado;
        }

		public function getControles($amenaza){
			$sql = "SELECT C.idcontrol, C.control, C.plazos, C.\"fechaInicio\", C.\"fechaFin\", C.costo, (E.apellidos || ' ' || E.nombres) AS empleado FROM control C LEFT JOIN empleado E ON C.idempleado = E.idempleado WHERE C.idamenaza = $amenaza";
			//var_dump($sql);
			$query = $this->conexion->query($sql);
			return $query;
		}
        
        public function getAmenazas(){
        	$sql = "SELECT * FROM amenazas";
        	$query = $this->conexion->query($sql);
        	return $query;
        }

        public function getImpacto(){
        	$sql = "SELECT idamenaza_impacto AS id, detalle, color FROM amenaza_impacto";
        	$query = $this->conexion->query($sql);
        	return $query;
        }

        public function getImportancia(){
        	$sql = "SELECT idamenaza_importancia AS id, detalle, color FROM amenaza_importancia";
        	$query = $this->conexion->query($sql);
        	return $query;
        }

        public function getProbabilidad(){
        	$sql = "SELECT idamenaza_probabilidad AS id, detalle, color FROM amenaza_probabilidad";
        	$query = $this->conexion->query($sql);
        	return $query;
        }

        public function getRiesgo(){
        	$sql = "SELECT idamenaza_riesgo AS id, detalle, color FROM amenaza_riesgo";
        	$query = $this->conexion->query($sql);
        	return $query;
        }


    }
