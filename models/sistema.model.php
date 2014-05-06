<?php

	require_once "database.model.php";

	class Sistema{

		private $conexion;

		public function __construct(){
			$this->conexion = new Database();
		}

		public function AutenticarUsuario($usuario, $clave){
			$sw = true;
				$sql = "SELECT idusuario, usuario, clave, activo, idempresa FROM usuario WHERE usuario = '".$usuario."' AND clave LIKE '".$clave."'";
				$query = $this->conexion->query($sql) or $sw = false;
			return $query;
		}

	}