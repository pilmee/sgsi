<?php
	require_once "database.model.php";

	class Proyecto{

		private $conexion;

		public function __construct(){
			$this->conexion = new Database();
		}

		public function AbrirTarea($tarea){
			$sql = "SELECT T.* FROM tarea T  WHERE T.idtarea=$tarea";
			//var_dump($sql);
			$query = $this->conexion->query($sql);
			return $query;
		}

		public function NuevaTarea($objetivo){
			$sw = true;
			$sql = "INSERT INTO tarea(idgap, detalle) VALUES ($objetivo, 'Nueva Tarea')";
			$this->conexion->query($sql) or $sw = false;
			return $sw;
		}

		public function ActualizarTarea($idtarea, $tarea, $inicio, $fin, $completado, $descripcion){
			if($inicio == 'NULL' && $fin == 'NULL'){
				$sql = "UPDATE tarea SET detalle='".$tarea."', inicio=NULL, fin=NULL, completado='".$completado."', descripcion='".$descripcion."' WHERE idtarea= $idtarea";
			}elseif ($inicio == 'NULL' && $fin != 'NULL') {
				$sql = "UPDATE tarea SET detalle='".$tarea."', inicio=NULL, fin='".$fin."', completado='".$completado."', descripcion='".$descripcion."' WHERE idtarea= $idtarea";
			}elseif ($inicio != 'NULL' && $fin == 'NULL') {
				$sql = "UPDATE tarea SET detalle='".$tarea."', inicio='".$inicio."', fin=NULL, completado='".$completado."', descripcion='".$descripcion."' WHERE idtarea= $idtarea";
			}else{
				$sql = "UPDATE tarea SET detalle='".$tarea."', inicio='".$inicio."', fin='".$fin."', completado='".$completado."', descripcion='".$descripcion."' WHERE idtarea= $idtarea";
			}
			//var_dump($sql);
			$query = $this->conexion->query($sql);
			return $query;
		}

		public function ConsultarTareas($objetivo){
			$sql = "SELECT T.* FROM tarea T INNER JOIN gap G on T.idgap = G.id WHERE T.idgap=$objetivo";
			//var_dump($sql);
			$query = $this->conexion->query($sql);
			return $query;
		}

		public function CalcularAvanceDelProyecto(){
			$sql = "SELECT COUNT(*) as total, (SELECT COUNT(*) FROM tarea TA1 WHERE TA1.completado = TRUE) AS completados, ((SELECT COUNT(*) FROM tarea TA1 WHERE TA1.completado = TRUE)*100/COUNT(*)) as avance FROM tarea";
			$query = $this->conexion->query($sql);
			return $query;
		}


		/*** DETALLES ***/

		public function AgregarResponsable($tarea, $empleado){
			$sw = true;
			$sql = "INSERT INTO tarea_responsable(idtarea, idempleado) VALUES ($tarea, $empleado)";
			$this->conexion->query($sql) or $sw = false;
			return $sw;
		}
		public function AgregarDocumentoEmpresa($tarea, $documento){
			$sw = true;
			$sql = "INSERT INTO tarea_docempresa(idtarea, documento) VALUES ($tarea, '".$documento."')";
			$this->conexion->query($sql) or $sw = false;
			return $sw;
		}
		public function AgregarDocumentoConsultora($tarea, $documento){
			$sw = true;
			$sql = "INSERT INTO tarea_docconsultora(idtarea, documento) VALUES ($tarea, '".$documento."')";
			$this->conexion->query($sql) or $sw = false;
			return $sw;
		}

		public function EliminarResponsable($tarea, $empleado){
			$sw = true;
			$sql = "DELETE FROM tarea_responsable WHERE idtarea = $tarea AND idempleado = $empleado";
			$this->conexion->query($sql) or $sw = false;
			return $sw;
		}
		public function EliminarDocumentoEmpresa($id){
			$sw = true;
			$sql = "DELETE FROM tarea_docempresa WHERE idtarea_docempresa = $id";
			//var_dump($sql);
			$this->conexion->query($sql) or $sw = false;
			return $sw;
		}
		public function EliminarDocumentoConsultora($id){
			$sw = true;
			$sql = "DELETE FROM tarea_docconsultora WHERE idtarea_docconsultora = $id";
			$this->conexion->query($sql) or $sw = false;
			return $sw;
		}

		public function ConsultarResponsables($tarea){
			$sql = "SELECT TR.idtarea, TR.idempleado, E.nombres, E.apellidos, C.nombre AS cargo, EM.nombre AS empresa FROM tarea_responsable TR 
							INNER JOIN tarea T ON T.idtarea = TR.idtarea
							INNER JOIN empleado E ON E.idempleado = TR.idempleado
							INNER JOIN cargo C ON E.idcargo = C.idcargo
							INNER JOIN empresa EM ON E.idempresa = EM.idempresa
						WHERE TR.idtarea = $tarea";
				//var_dump($sql);
			$query = $this->conexion->query($sql);
			return $query;
		}
		public function ConsultarDocumentosEmpresa($tarea){
			$sql = "SELECT TE.documento, TE.idtarea, TE.idtarea_docempresa FROM tarea_docempresa TE INNER JOIN tarea T ON T.idtarea = TE.idtarea WHERE TE.idtarea = $tarea";
			$query = $this->conexion->query($sql);
			return $query;
		}

		public function ConsultarDocumentosConsultora($tarea){
			$sql = "SELECT TC.documento,TC.documento, TC.idtarea, TC.idtarea_docconsultora FROM tarea_docconsultora TC INNER JOIN tarea T ON T.idtarea = TC.idtarea WHERE TC.idtarea = $tarea";
			$query = $this->conexion->query($sql);
			return $query;
		}


		/*** CALENDARIO ***/

		public function ConsultarTareasSegunMesAno($mostrar, $dia, $mes, $ano){
			switch ($mostrar) {
				case 'inicio':
					# code...
						$sql = "SELECT * FROM tarea WHERE extract(month from inicio) = $mes AND extract(year from inicio) = $ano AND extract(day from inicio) = $dia";
					break;
				case 'fin':
						$sql = "SELECT * FROM tarea WHERE extract(month from fin) = $mes AND extract(year from fin) = $ano AND extract(day from fin) = $dia";
					# code...
					break;
				default:
					$d = $dia;
					if($dia>0&&$dia<=9){ $d = "0$dia"; }
					$fecha = "$ano-$mes-$d";
					var_dump($fecha);
					$sql = "SELECT * FROM tarea WHERE inicio >= '".$fecha."' AND fin <= '".$fecha."';";
					//var_dump($sql);
					# code...
					break;
			}
			//var_dump($sql);
			$query = $this->conexion->query($sql);
			return $query;
		}

	}