<?php
	require_once "database.model.php";

	class Gap{

		private $conexion;

		public function __construct(){
			$this->conexion = new Database();
		}

		public function ConsultarTotalesControl(){
			$sql = "select (select count(*) from gap where id_padre IS NOT NULL AND control = TRUE ) as total, (select count(*) from gap where estado=3 and id_padre IS NOT NULL AND control = TRUE ) as implementado, (select count(*) from gap where estado=2 and id_padre IS NOT NULL AND control = TRUE ) as parcialmente_implementado, (select count(*) from gap where estado=1 and id_padre IS NOT NULL AND control = TRUE ) as no_implementado,(select count(*) from gap where estado=0 and id_padre IS NOT NULL AND control = TRUE ) as no_definido  from gap LIMIT 1";
			$query = $this->conexion->query($sql);
			return $query;
		}

		public function ConsultarTotalesControlSegunDominio(){
			$sql = "SELECT 	indice, detalle, (select count(*) from gap where id_padre = G.id AND control = TRUE) as total,(select count(*) from gap where id_padre = G.id AND estado = 0 AND control = TRUE) as no_definido,(select count(*) from gap where id_padre = G.id AND estado = 1 AND control = TRUE) as no_implementado,(select count(*) from gap where id_padre = G.id AND estado = 2 AND control = TRUE) as parcialmente_implementado,(select count(*) from gap where id_padre = G.id AND estado = 3 AND control = TRUE) as implementado, (((select count(*) from gap where id_padre = G.id AND estado = 0 AND control = TRUE)+(select count(*) from gap where id_padre = G.id AND estado = 1 AND control = TRUE)+(select count(*) from gap where id_padre = G.id AND estado = 2 AND control = TRUE)+(select count(*) from gap where id_padre = G.id AND estado = 3 AND control = TRUE))/4.00) as promedio FROM gap G WHERE control = FALSE AND id_padre IS NOT NULL ORDER BY id";
			$query = $this->conexion->query($sql);
			return $query;
		}

		public function ActualizarControl($opcion, $control, $valor){
			$sw = true;
			$campo = "";
			$sql = "UPDATE gap SET ";
		    switch($opcion){
		    	case 'aplica':		$sql .= "aplica=$valor WHERE id = $control";
		    						$campo = "aplica";
		    		break;
		    	case 'implementar': $sql .= "estado=$valor WHERE id = $control";
		    						$campo = "estado";
		    		break;
		    	case 'observacion': $sql .= "observacion='".$valor."' WHERE id = $control";
		    						$campo = "observacion";
		    		break;
		    }
		    //var_dump($sql);
		    
		    	/*** GUARDAR EN BITACORA GAP ***/
		    			$sql_bitacora_pre = "SELECT count(*) AS total, (SELECT $campo FROM gap G WHERE G.id = $control) AS anterior FROM gap_bitacora GB WHERE campo = '".$campo."' AND GB.idgap = $control";
		    			var_dump($sql_bitacora_pre);
		    			$query_bitacora_pre = $this->conexion->query($sql_bitacora_pre);
		    			$reg_bitacora_pre = $query_bitacora_pre->fetchObject();
		    			//if($reg_bitacora_pre->total <= 1){
		    				//FALTA CORREGIR OBSERVACIONES SE INSERTAN MUCHOS NULLS
		    				$ant = $reg_bitacora_pre->anterior; 
				    		$sql_bitacora = "INSERT INTO gap_bitacora(idgap, anterior, actual, campo) VALUES ($control, '".$ant."', '".$valor."', '".$campo."')";
				    		$this->conexion->query($sql_bitacora);
				    	//}
		    	/*** FIN BITACORA ****/
		    $this->conexion->query($sql) or $sw = false;
		    return $sw;
		}

		public function ConsultarBitacoraGap($control){
			$sql = "select * from gap_bitacora GB inner join gap G on G.id = GB.idgap where idgap = $control";
			$query = $this->conexion->query($sql);
			return $query;
		}

		public function ConsultarDominios(){
			$sql = "SELECT DISTINCT  G.id, G.id_padre, G.detalle, G.indice, G.aplica, G.estado, G.observacion FROM gap G  WHERE G.id_padre IS NULL ORDER BY G.id ASC";
			$query = $this->conexion->query($sql);
			return $query;
		}

		public function ConsultarObjetivos($dominio){
			$sql = "SELECT DISTINCT  G.id, G.id_padre, G.detalle, G.indice, G.aplica, G.estado, G.observacion FROM gap G LEFT JOIN gap GAP ON G.id = GAP.id_padre WHERE G.id_padre IS NOT NULL AND G.id_padre = $dominio ORDER BY G.id ASC";
			$query = $this->conexion->query($sql);
			return $query;
		}

		public function ConsultarControles($objetivo){
			$sql = "SELECT DISTINCT  G.id, G.id_padre, G.detalle, G.indice, G.aplica, G.estado, G.observacion FROM gap G LEFT JOIN gap GAP ON G.id = GAP.id_padre wHERE G.id_padre IS NOT NULL AND G.id_padre = $objetivo ORDER BY G.id ASC";
			$query = $this->conexion->query($sql);
			return $query;
		}


	}