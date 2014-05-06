<?php
	require_once "database.model.php";

	class Activo{
		
		private $coneixon;

		public function __construct(){
            $this->conexion = new Database();
        }

        public function AbrirActivo($activo){
        	$sql = "SELECT A.idactivo, A.activo, A.uds, A.propietario, A.ubicacion_fisica, A.version, A.descripcion, A.marca_modelo, A.fuente_distribuidor, AC.idactivo_categoria, ACO.idactivo_confidencialidad, AD.idactivo_disponibilidad, AI.idactivo_importancia, AIN.idactivo_integridad  FROM activo A 
						LEFT JOIN activo_categoria AC ON A.idactivo_categoria = AC.idactivo_categoria
						LEFT JOIN activo_confidencialidad ACO ON A.idactivo_confidencialidad = ACO.idactivo_confidencialidad
						LEFT JOIN activo_disponibilidad AD ON A.idactivo_disponibilidad = AD.idactivo_disponibilidad
						LEFT JOIN activo_importancia AI ON A.idactivo_importancia = AI.idactivo_importancia
						LEFT JOIN activo_integridad AIN ON A.idactivo_integridad = AIN.idactivo_integridad
					WHERE A.idactivo = $activo";
			$query = $this->conexion->query($sql);
			return $query;
        }

        public function NuevaActivo($activo, $empresa, $fecha){
        	$sw = true;
        	$sql = "INSERT INTO activo(activo, idempresa, fecha) VALUES ('".$activo."', $empresa, '".$fecha."')";
        	var_dump($sql);
        	$this->conexion->query($sql) or $sw = false;
        	return $sw;
        }
		
		public function EliminarActivo($activo){
			$sw = true;
			$sql = "DELETE FROM activo WHERE idactivo = $activo";
			$this->conexion->query($sql) or $sw = false;
			return $sw;
		}
		
        public function ConsultarActivos(){
        	$sql = "SELECT A.idactivo, A.activo, A.uds, A.propietario, AC.detalle AS categoria, ACO.detalle AS confidencialidad, ACO.color AS colorConfidencialidad,
        				   AD.detalle AS disponibilidad, AD.color AS colorDisponibilidad, AI.detalle AS importancia, AI.color AS colorImportancia, 
        				   AIN.detalle AS integridad, AIN.color AS colorIntegridad 
        			FROM activo A 
						LEFT JOIN activo_categoria AC ON A.idactivo_categoria = AC.idactivo_categoria
						LEFT JOIN activo_confidencialidad ACO ON A.idactivo_confidencialidad = ACO.idactivo_confidencialidad
						LEFT JOIN activo_disponibilidad AD ON A.idactivo_disponibilidad = AD.idactivo_disponibilidad
						LEFT JOIN activo_importancia AI ON A.idactivo_importancia = AI.idactivo_importancia
						LEFT JOIN activo_integridad AIN ON A.idactivo_integridad = AIN.idactivo_integridad";
			$query = $this->conexion->query($sql);
			return $query;
        }

        public function GuardarActivo($id, $activo, $unidades, $propietario, $categoria, $confidencialidad, $integridad, $disponibilidad, $importancia, $ubicacion_fisica, $version, $descripcion, $marca_modelo, $fuente_distribuidor){
        	$sw = true;
        	$sql = "UPDATE activo
					   SET activo='".$activo."', uds='".$unidades."', idactivo_categoria=$categoria, propietario='".$propietario."', 
					       idactivo_confidencialidad=$confidencialidad, idactivo_integridad=$integridad, idactivo_disponibilidad=$disponibilidad, 
					       idactivo_importancia=$importancia, ubicacion_fisica='".$ubicacion_fisica."', version='".$version."', descripcion='".$descripcion."', 
					       marca_modelo='".$marca_modelo."', fuente_distribuidor='".$fuente_distribuidor."' 
					WHERE idactivo = $id";
			//var_dump($sql);
        	$this->conexion->query($sql) or $sw = false;
        	return $sw;
        }

        /*** GESTION DE RIESGOS CONSULTAS ***/

        public function ConsultarActivosSimple(){
            $sql = "SELECT idactivo, activo, AC.detalle AS categoria FROM activo A LEFT JOIN activo_categoria AC ON A.idactivo_categoria = AC.idactivo_categoria";
            $query = $this->conexion->query($sql);
            return $query;
        }


        /*** DETALLES ***/

        public function getCategorias(){
        	$sql = "SELECT idactivo_categoria AS id, detalle FROM activo_categoria";
        	$query = $this->conexion->query($sql);
        	return $query;
        }

        public function getConfidencialidad(){
        	$sql = "SELECT idactivo_confidencialidad AS id, detalle, color FROM activo_confidencialidad";
        	$query = $this->conexion->query($sql);
        	return $query;
        }

        public function getDisponibilidad(){
        	$sql = "SELECT idactivo_disponibilidad AS id, detalle, color FROM activo_disponibilidad";
        	$query = $this->conexion->query($sql);
        	return $query;
        }

        public function getImportancia(){
        	$sql = "SELECT idactivo_importancia AS id, detalle, color FROM activo_importancia";
        	$query = $this->conexion->query($sql);
        	return $query;
        }

        public function getIntegridad(){
        	$sql = "SELECT idactivo_integridad AS id, detalle, color FROM activo_integridad";
        	$query = $this->conexion->query($sql);
        	return $query;
        }
	}