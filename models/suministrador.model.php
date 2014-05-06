<?php
	require_once "database.model.php";

	class Suministrador{

		private $conexion;

		public function __construct(){
			$this->conexion = new Database();
		}

		public function NuevoSuministrador($empresa,$razon_social, $indicador_asociado, $descripcion){
			$sw = true;
			$sql = "INSERT INTO suministrador(idempresa, razon_social, idindicador_asociado, descripcion)
    				VALUES ($empresa,'".$razon_social."',$indicador_asociado,'".$descripcion."')";
    		var_dump($sql);
			$this->conexion->query($sql) or $sw = false;
			return $sw;
		}

		public function ConsultarSuministradores(){
			$sql = "SELECT * FROM suministrador S inner join indicador_asociado IA on S.idindicador_asociado = IA.idindicador_asociado";
			$query = $this->conexion->query($sql);
			return $query;
		}

		public function EliminarSuministrador($idsuministrador){
			$sw = true;
			$sql = "DELETE FROM suministrador WHERE idsuministrador = $idsuministrador";
			$this->conexion->query($sql) or $sw = false;
			return $sw;
		}

		public function AbrirSuministrador($idsuministrador){
			$sql = "SELECT * FROM suministrador WHERE idsuministrador=$idsuministrador";
			$query = $this->conexion->query($sql);
			return $query;
		}

		public function ConsultarIndicadoresAsociados(){
			$sql = "SELECT * FROM indicador_asociado";
			$query = $this->conexion->query($sql);
			return $query;
		}

		public function ActualizarSuministrador($id,$ruc,$razonSocial,$responsable,$direccion,$poblacion,$provincia,$pais,$descripcion,$estado,$comentario,$indicadorAsociado){
			$sw = true;
			$est = 'FALSE';	
			$emp = 'NULL';
			if($estado == 1){ $est = 'TRUE'; }
			if(!empty($responsable)){ $emp = $responsable; }
			$sql = "UPDATE suministrador SET \"RUC\"=$ruc, razon_social='".$razonSocial."', descripcion='".$descripcion."', idempleado=$emp, direccion='".$direccion."', poblacion=$poblacion, provincia='".$provincia."', pais='".$pais."', comentario='".$comentario."', idindicador_asociado='".$indicadorAsociado."', estado=$est WHERE idsuministrador = $id";
			//var_dump($sql);
			$this->conexion->query($sql) or $sw = false;
			return $sw;
		}

		/*** DETALLES ***/
		//inserciones
		public function AgregarContrato($idsuministrador, $detalle, $inicio, $fin, $soporte){
			$sw = true;
			$sql = "INSERT INTO contrato(idsuministrador, detalle, inicio, fin, soporte)
				    VALUES ($idsuministrador, '".$detalle."', '".$inicio."', '".$fin."', '".$soporte."')";
			$this->conexion->query($sql) or $sw = false;
			return $sw;
		}

		public function AgregarContacto($idsuministrador, $nombre, $cargo, $telefono, $email, $comentario){
			$sw = true;
			$sql = "INSERT INTO contacto(idsuministrador, nombre, cargo, telefono, email, comentario)
					VALUES ($idsuministrador, '".$nombre."', '".$cargo."', '".$telefono."', '".$email."', '".$comentario."')";
				//var_dump($sql);
			$this->conexion->query($sql) or $sw = false;
			return $sw;
		}

		public function AgregarSLA($idsuministrador, $nombre, $descripcion){
			$sw = true;
			$sql = "INSERT INTO sla(idsuministrador, nombre, descripcion)VALUES ($idsuministrador, '".$nombre."', '".$descripcion."')";
			$this->conexion->query($sql) or $sw = false;
			return $sw;
		}

		public function AgregarSeguimiento($idsuministrador, $usuario, $fecha, $descripcion){
			$sw = true;
			$sql = "INSERT INTO seguimiento(idsuministrador, usuario, fecha, descripcion) VALUES ($idsuministrador, '".$usuario."', '".$fecha."', '".$descripcion."')";
			$this->conexion->query($sql) or $sw = false;
			return $sw;
		}

		//CONSULTAS
		public function ConsultarContrato($suministrador){
			$sql = "SELECT C.idcontrato, C.detalle, C.inicio, C.fin, C.soporte FROM contrato C INNER JOIN suministrador S ON S.idsuministrador = C.idsuministrador WHERE S.idsuministrador = $suministrador";
			$query = $this->conexion->query($sql);
			return $query;
		}

		public function ConsultarContacto($suministrador){
			$sql = "SELECT C.idcontacto, C.nombre, C.cargo, C.telefono, C.email, C.comentario FROM contacto C INNER JOIN suministrador S ON S.idsuministrador = C.idsuministrador WHERE S.idsuministrador = $suministrador";
			$query = $this->conexion->query($sql);
			return $query;
		}

		public function ConsultarSLA($suministrador){
			$sql = "SELECT SL.idsla, Sl.nombre, SL.descripcion FROM sla SL INNER JOIN suministrador S ON S.idsuministrador = SL.idsuministrador WHERE S.idsuministrador = $suministrador";
			$query = $this->conexion->query($sql);
			return $query;
		}

		public function ConsultarSeguimiento($suministrador){
			$sql = "SELECT SE.idseguimiento, SE.usuario, SE.fecha, SE.descripcion FROM seguimiento SE INNER JOIN suministrador S ON S.idsuministrador = SE.idsuministrador WHERE S.idsuministrador = $suministrador";
			$query = $this->conexion->query($sql);
			return $query;
		}

		//Eliminaciones

		public function EliminarContrato($id){
			$sw = true;
			$sql = "DELETE FROM contrato WHERE idcontrato=$id";
			$this->conexion->query($sql) or $sw = false;
			return $sw;
		}

		public function EliminarContacto($id){
			$sw = true;
			$sql = "DELETE FROM contacto WHERE idcontacto=$id";
			$this->conexion->query($sql) or $sw = false;
			return $sw;
		}

		public function EliminarSLA($id){
			$sw = true;
			$sql = "DELETE FROM sla  WHERE idsla=$id";
			$this->conexion->query($sql) or $sw = false;
			return $sw;
		}

		public function EliminarSeguimiento($id){
			$sw = true;
			$sql = "DELETE FROM seguimiento WHERE idseguimiento=$id";
			$this->conexion->query($sql) or $sw = false;
			return $sw;
		}
	}