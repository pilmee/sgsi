<?php
	require_once "../../models/activo.model.php";
	require_once "../../models/amenaza.model.php";

    $objActivo = new Activo();
    $objAmenaza = new Amenaza();

	$operacion = $_GET["operacion"];

	switch($operacion){
		case 'mostrar-todos':	echo MostrarTodos();
			# code...
			break;
		case 'superan-nra':		echo SuperanNRA();
			# code...
			break;
		case 'sin-control':		echo SinControl();
			# code...
			break;
		case 'sin-control-superan-nra':	echo SinControlSuperanNRA();
			# code...
			break;
		default:	echo MostrarTodos();

	}

	function MostrarTodos(){
		global $objActivo;
		global $objAmenaza;
		$data = "";
		$query_activos = $objActivo->ConsultarActivosSimple();
		$i = 1;

		while ($reg = $query_activos->fetchObject()) {
			$query_amenazas = $objAmenaza->ConsultarAmenazasSegunActivoyRiesgo($reg->idactivo,4);
			$amenazas_numero = $query_amenazas->rowCount() > 0 ? $query_amenazas->rowCount()+1 : "";

			$data .= "<tr>";
			$data .= "<td rowspan='".$amenazas_numero."'>$i</td><td colspan='2'>$reg->activo</td><td>$reg->categoria</td><td></td>";
			$data .= "</tr>";

			$j = 1;
			while ($reg_amenaza = $query_amenazas->fetchObject()) {
				$data .= "<tr>";
				$data .= "<td class='center' style='width:20px'><input type='checkbox' name='chkAmenaza' value='".$reg_amenaza->idamenaza."' /></td><td>$j. $reg_amenaza->amenaza<span class='badge pull-right'>$reg_amenaza->numerocontroles</span></td><td>$reg->categoria</td><td class='center' style='background:".$reg_amenaza->colorriesgo."'>$reg_amenaza->detalle</td>";
				$data .= "</tr>";
				$j++;
			}

			$i++;
		}

		return $data;
	}

	function SuperanNRA(){
		global $objActivo;
		global $objAmenaza;
		$data = "";
		$query_activos = $objActivo->ConsultarActivosSimple();
		$i = 1;

		while ($reg = $query_activos->fetchObject()) {
			$query_amenazas = $objAmenaza->ConsultarAmenazasSegunActivoyNRA($reg->idactivo,4,4);
			$amenazas_numero = $query_amenazas->rowCount() > 0 ? $query_amenazas->rowCount()+1 : "";

			$data .= "<tr>";
			$data .= "<td rowspan='".$amenazas_numero."'>$i</td><td colspan='2'>$reg->activo</td><td>$reg->categoria</td><td></td>";
			$data .= "</tr>";

			$j = 1;
			while ($reg_amenaza = $query_amenazas->fetchObject()) {
				$data .= "<tr>";
				$data .= "<td class='center' style='width:20px'><input type='checkbox' /></td><td>$j. $reg_amenaza->amenaza<span class='badge pull-right'>$reg_amenaza->numerocontroles</span></td><td>$reg->categoria</td><td class='center' style='background:".$reg_amenaza->colorriesgo."'>$reg_amenaza->detalle</td>";
				$data .= "</tr>";
				$j++;
			}

			$i++;
		}

		return $data;
	}

	function SinControl(){
		global $objActivo;
		global $objAmenaza;
		$data = "";
		$query_activos = $objActivo->ConsultarActivosSimple();
		$i = 1;

		while ($reg = $query_activos->fetchObject()) {
			$query_amenazas = $objAmenaza->ConsultarAmenazasSegunActivoySinControles($reg->idactivo,4,4);
			$amenazas_numero = $query_amenazas->rowCount() > 0 ? $query_amenazas->rowCount()+1 : "";

			$data .= "<tr>";
			$data .= "<td rowspan='".$amenazas_numero."'>$i</td><td colspan='2'>$reg->activo</td><td>$reg->categoria</td><td></td>";
			$data .= "</tr>";

			$j = 1;
			while ($reg_amenaza = $query_amenazas->fetchObject()) {
				$data .= "<tr>";
				$data .= "<td class='center' style='width:20px'><input type='checkbox' /></td><td>$j. $reg_amenaza->amenaza<span class='badge pull-right'>$reg_amenaza->numerocontroles</span></td><td>$reg->categoria</td><td class='center' style='background:".$reg_amenaza->colorriesgo."'>$reg_amenaza->detalle</td>";
				$data .= "</tr>";
				$j++;
			}

			$i++;
		}

		return $data;
	}

	function SinControlSuperanNRA(){
		global $objActivo;
		global $objAmenaza;
		$data = "";
		$query_activos = $objActivo->ConsultarActivosSimple();
		$i = 1;

		while ($reg = $query_activos->fetchObject()) {
			$query_amenazas = $objAmenaza->ConsultarAmenazasSegunActivoySinControlesyNRA($reg->idactivo,4,4);
			$amenazas_numero = $query_amenazas->rowCount() > 0 ? $query_amenazas->rowCount()+1 : "";

			$data .= "<tr>";
			$data .= "<td rowspan='".$amenazas_numero."'>$i</td><td colspan='2'>$reg->activo</td><td>$reg->categoria</td><td></td>";
			$data .= "</tr>";

			$j = 1;
			while ($reg_amenaza = $query_amenazas->fetchObject()) {
				$data .= "<tr>";
				$data .= "<td class='center' style='width:20px'><input type='checkbox' /></td><td>$j. $reg_amenaza->amenaza<span class='badge pull-right'>$reg_amenaza->numerocontroles</span></td><td>$reg->categoria</td><td class='center' style='background:".$reg_amenaza->colorriesgo."'>$reg_amenaza->detalle</td>";
				$data .= "</tr>";
				$j++;
			}

			$i++;
		}

		return $data;
	}