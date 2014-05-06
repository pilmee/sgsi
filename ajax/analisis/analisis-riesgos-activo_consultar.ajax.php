<?php
require_once "../../models/activo.model.php";
$objActivo = new Activo();
$pag = $_GET["pag"];

if(isset($_GET["exportar"]) && !empty($_GET["exportar"]) && ( $_GET["exportar"] == true || $_GET["exportar"] == "true" )){
    $fechaHora = date("dmyis");
    header("Content-Type: application/vnd.ms-excel");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("content-disposition: attachment;filename=ListatadoActivos$fechaHora.xls");
    echo Ninguno();
}else{



    switch ($_GET["orden"]) {
        case 'ninguno':
        echo Ninguno();
        break;
        case 'confidencialidad':
        echo Confidencialidad();
        break;
        case 'integridad':
        echo Integridad();
        break;
        case 'disponibilidad':
        echo Disponibilidad();
        break;
        case 'importancia':
        echo Importancia();
        break;

        default:
        # code...
        echo Ninguno();
        break;
    }
}

function Importancia(){
    global $objActivo;
    global $pag;

    $data = '<table class="table table-condensed table-hover" style="font-size:0.9em">
    			<thead>
    				<th>#</th>
    				<th>Activo</th>
    				<th class="center">Categoria</th>
    				<th class="center">Importancia</th>
    				<th class="center">% Completado</th>
    				<th class="center">Propuestas</th>
    			</thead>
    			<tbody>';

    $query_activos = $objActivo->ConsultarActivos();
    $i = 1;
    while($reg = $query_activos->fetchObject()){

        $activo = $reg->idactivo;
        $data .= "<tr><td>$i</td><td><a href='?pag=$pag&activo=$activo'>".$reg->activo."</a></td><td class='center'>".$reg->categoria."</td><td class='center' style='background:".$reg->colorimportancia."'>".$reg->importancia."</td><td clas='center'></td><td clas='center'></td></tr>";
        $i++;
    }

    $data .= '</tbody></table>';
    return $data;
}

function Disponibilidad(){
    global $objActivo;
    global $pag;

    $data = '<table class="table table-condensed table-hover" style="font-size:0.9em">
    			<thead>
    				<th>#</th>
    				<th>Activo</th>
    				<th class="center">Categoria</th>
    				<th class="center">Disponibilidad</th>
    				<th class="center">% Completado</th>
    				<th class="center">Propuestas</th>
    			</thead>
    			<tbody>';

    $query_activos = $objActivo->ConsultarActivos();
    $i = 1;
    while($reg = $query_activos->fetchObject()){

        $activo = $reg->idactivo;
        $data .= "<tr><td>$i</td><td><a href='?pag=$pag&activo=$activo'>".$reg->activo."</a></td><td class='center'>".$reg->categoria."</td><td class='center' style='background:".$reg->colordisponibilidad."'>".$reg->disponibilidad."</td><td clas='center'></td><td clas='center'></td></tr>";
        $i++;
    }

    $data .= '</tbody></table>';
    return $data;
}

function Integridad(){
    global $objActivo;
    global $pag;

    $data = '<table class="table table-condensed table-hover" style="font-size:0.9em">
    			<thead>
    				<th>#</th>
    				<th>Activo</th>
    				<th class="center">Categoria</th>
    				<th class="center">Integridad</th>
    				<th class="center">% Completado</th>
    				<th class="center">Propuestas</th>
    			</thead>
    			<tbody>';

    $query_activos = $objActivo->ConsultarActivos();
    $i = 1;
    while($reg = $query_activos->fetchObject()){

        $activo = $reg->idactivo;
        $data .= "<tr><td>$i</td><td><a href='?pag=$pag&activo=$activo'>".$reg->activo."</a></td><td class='center'>".$reg->categoria."</td><td class='center' style='background:".$reg->colorintegridad."'>".$reg->integridad."</td><td clas='center'></td><td clas='center'></td></tr>";
        $i++;
    }

    $data .= '</tbody></table>';
    return $data;
}

function Confidencialidad(){
    global $objActivo;
    global $pag;

    $data = '<table class="table table-condensed table-hover" style="font-size:0.9em">
    			<thead>
    				<th>#</th>
    				<th>Activo</th>
    				<th class="center">Categoria</th>
    				<th class="center">Confidencialidad</th>
    				<th class="center">% Completado</th>
    				<th class="center">Propuestas</th>
    			</thead>
    			<tbody>';

    $query_activos = $objActivo->ConsultarActivos();
    $i = 1;
    while($reg = $query_activos->fetchObject()){

        $activo = $reg->idactivo;
        $data .= "<tr><td>$i</td><td><a href='?pag=$pag&activo=$activo'>".$reg->activo."</a></td><td class='center'>".$reg->categoria."</td><td class='center' style='background:".$reg->colorconfidencialidad."'>".$reg->confidencialidad."</td><td clas='center'></td><td clas='center'></td></tr>";
        $i++;
    }

    $data .= '</tbody></table>';
    return $data;
}

function Ninguno(){
    global $objActivo;
    global $pag;
    $data = '<table class="table table-condensed table-hover" style="font-size:0.9em">
    			<thead>
    				<th>#</th>
    				<th>Activo</th>
    				<th class="center">Categoria</th>
    				<th class="center">% Completado</th>
    				<th class="center">Propuestas</th>
    			</thead>
    			<tbody>';

    $query_activos = $objActivo->ConsultarActivos();
    $i = 1;
    while($reg = $query_activos->fetchObject()){

        $activo = $reg->idactivo;
        $data .= "<tr><td>$i</td><td><a href='?pag=$pag&activo=$activo'>".$reg->activo."</a></td><td class='center'>".$reg->categoria."</td><td clas='center'></td><td clas='center'></td></tr>";
        $i++;
    }

    $data .= '</tbody></table>';
    return $data;
}