<?php
    
    require_once "../../models/acta_reunion.model.php";
        $objActaReunion = new Acta_Reunion();

    $query_acta_reunion = $objActaReunion->ConsultarActas();
    while($reg = $query_acta_reunion->fetchObject()){
        $pag = $_GET["pag"];
        echo '<tr><td><a href="?pag=$pag&acta='.$reg->idacta_reunion.'">'.$reg->asunto.'</a></td><td>'.$reg->fecha.'</td><td>'.$reg->nombre.'</td><td><input type="checkbox" name="actas[]" value="'.$reg->idacta_reunion.'"></td></tr>';
    }