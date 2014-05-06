<?php
    require_once "database.model.php";

    class PlanTratamiento{
		
        private $coneixon;

        public function __construct(){
            $this->conexion = new Database();
        }
        
        public function nuevoPlanTratamiento($nombre, $fecha){
            $sw = true;
                $sql = "INSERT INTO plan_tratamiento(nombres) VALUES ('".$nombre."')";
		//var_dump($sql);
                $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        public function actualizarPlanTratamiento($id, $nombres, $soa, $empleado, $recursos, $plazo, $coste = "0.00", $observaciones){
            $sw = true;
	    
		if($recursos != 'null'){ $recursos = "'".$recursos."'"; }
		if($plazo != 'null'){ $plazo = "'".$plazo."'"; }
		if($coste != 'null'){ $coste = "'".$coste."'"; }
		if($observaciones != 'null'){ $observaciones = "'".$observaciones."'"; }
                $sql = "UPDATE plan_tratamiento SET nombres='".$nombres."', \"controlSOA\"='".$soa."', idempleado=$empleado, recursos=$recursos , plazo=$plazo, coste=$coste, observaciones=$observaciones WHERE idplan_tratamiento = $id";
		//var_dump($sql);
                $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        public function eliminarPlanTratamiento($id){
            $sw = true; 
                $sql = "DELETE FROM plan_tratamiento WHERE idplan_tratamiento = $id";
                $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        public function consultarPlanesTratamiento(){
            $sql = "SELECT * FROM plan_tratamiento";
            $query = $this->conexion->query($sql);
            return $query;
        }
        
        public function abrirPlanTratamiento($id){
            $sql = "SELECT * FROM plan_tratamiento WHERE idplan_tratamiento = $id";
            $query = $this->conexion->query($sql);
            return $query;
        }
	
	public function asociarPlanAmenazas($plan, $amenazas){
	    $sw = true;
	    $sql  = "";
	    foreach($amenazas as $indice => $valor){
		$sql = "INSERT INTO plan_tratamiento_asociacion_amenazas(idplan_tratamiento, idamenaza) VALUES ($plan, $valor)";
		$this->conexion->query($sql) or $sw = false;
	    }
	    return $sw;
	}
        
        /*** DETALLES ***/
        
        public function nuevoActivoRepercutido($plan, $activo){
            $sw = true;
                $sql = "INSERT INTO plan_tratamiento_activos_repercutidos(idplan_tratamiento, idactivo) VALUES ($plan, $activo)";
		//var_dump($sql);
                $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        public function eliminarActivoRepercutido($plan, $activo){
            $sw = true;
                $sql = "DELETE FROM plan_tratamiento_activos_repercutidos WHERE idplan_tratamiento=$plan AND idactivo=$activo";
                $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        public function consultarActivosRepercutidos($plan){
            $sql = "SELECT AR.idplan_tratamiento, AR.idactivo, A.activo FROM plan_tratamiento_activos_repercutidos AR inner join activo A ON AR.idactivo = A.idactivo WHERE idplan_tratamiento = $plan";
            $query = $this->conexion->query($sql);
            return $query;
        }
        
        //ACCIONES ASOACIADAS
        public function nuevaAccionAsociada($plan, $nombre, $empleado, $recursos, $plazo){
            $sw = true;
                $sql = "INSERT INTO plan_tratamiento_acciones_asociadas_control (nombre, idempleado, recursos, plazo, idplan_tratamiento) VALUES ('".$nombre."',$empleado,'".$recursos."','".$plazo."', $plan)";
                $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
        
        public function eliminarAccionAsociada($accion_asociada){
            $sw = true;
                $sql = "DELETE FROM plan_tratamiento_acciones_asociadas_control WHERE idacciones_asociadas_control = $accion_asociada";
                $this->conexion->query($sql) or $sw = false;
            return  $sw;
        }
        
        public function consultarAccionesAsociadas($plan){
            $sql = "SELECT PA.*, E.nombres FROM plan_tratamiento_acciones_asociadas_control PA inner join empleado E on PA.idempleado = E.idempleado WHERE idplan_tratamiento = $plan";
            $query = $this->conexion->query($sql);
            return $query;
        }
        
        
        //AMENAZAS ASOCIADAS
        public function nuevaAmenazaAsociada($plan, $amenaza){
            $sw = true;
                $sql = "INSERT INTO plan_tratamiento_asociacion_amenazas(idplan_tratamiento, idamenaza) VALUES ($plan, $amenaza)";
                $this->conexion->query($sql) or $sw = false;
            return $sw;
        }
	
	public function consultarAmenazaAsociada($plan){
	    $sql = "SELECT idplan_tratamiento, PA.idamenaza, PA.fecha, A.amenaza, AR.detalle, AR.color, AC.activo FROM plan_tratamiento_asociacion_amenazas PA inner join amenaza A ON PA.idamenaza = A.idamenaza inner join amenaza_riesgo AR on A.idamenaza_riesgo = AR.idamenaza_riesgo inner join activo AC on A.idactivo = AC.idactivo WHERE idplan_tratamiento = $plan";
	    $query = $this->conexion->query($sql);
	    return $query;	
	}
	
	public function eliminarAmenazaAsociada($plan, $amenaza){
	    $sw = true;
		$sql = "DELETE FROM plan_tratamiento_asociacion_amenazas WHERE idplan_tratamiento = $plan AND idamenaza = $amenaza";
		$this->coneixon->query($sql) or $sw = false;
	    return $sw;
	}
	
	//indicadores
	
	public function nuevoIndicador($plan, $indicador){
	    $sw = true;
		$sql = "INSERT INTO plan_tratamiento_indicadores(idplan_tratamiento, idindicador) VALUES ($plan, $indicador)";
		$this->coneixon->query($sql) or $sw = false;
	    return $sw;
	}
	public function eliminarIndicador($plan, $indicador){
	    $sw = true;
		$sql = "DELETE FROM plan_tratamiento_indicadores WHERE idplan_tratamiento = $plan AND idindicador = $indicador";
		$this->coneixon->query($sql) or $sw = false;
	    return $sw;
	}
	public function consultarIndicador($plan){
	    $sql = "SELECT PI.idplan_tratamiento, PI.idindicador, P.detalle FROM plan_tratamiento_indicadores PI inner join indicadores P ON PI.idindicador = P.idindicador WHERE PI.idplan_tratamiento = $plan";
	    $query = $this->conexion->query($sql);
	    return $query;
	}
        
	
	/*** CONTROLES PROPUESTOS ***/
	
	public function agregarControlPropuesto($plan, $control){
	    $sw = true;
		$sql = "INSERT INTO plan_tratamiento_control(idplan_tratamiento, idgap)VALUES ($plan, $control)";
		$this->conexion->query($sql) or $sw = false;
	    return $sw;
	}
	
        public function consultarControlesPropuestos($plan){
            $sql = "SELECT idplan_tratamiento, idgap, fecha, G.indice, G.detalle FROM plan_tratamiento_control P inner join gap G on P.idgap = G.id WHERE P.idplan_tratamiento =  $plan";
	    $query = $this->conexion->query($sql);
	    return $query;
        }
	
	public function eliminarControlPropuesto($plan, $control){
	    $sw = true;
		$sql = "DELETE FROM plan_tratamiento_control WHERE idplan_tratamiento = $plan AND idgap = $control";
		$this->conexion->query($sql) or $sw = false;
	    return $sw;
	}
	
        
    }