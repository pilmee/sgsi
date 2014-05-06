<?php
    
    require_once "../../models/objetivo.model.php";
        $objObjetivo = new Objetivo();
        
        $acta = $_GET["acta"];

    $query_acta_reunion = $objObjetivo->ConsultarObjetivos($acta);
    while($reg = $query_acta_reunion->fetchObject()){
        $pag = $_GET["pag"];
        echo '<tr><td><a href="?pag='.$pag.'&objetivo='.$reg->idobjetivo.'">'.$reg->objetivo.'</a></td><td>'.$reg->fecha.'</td><td>'.$reg->descripcion.'</td><td><input type="checkbox" name="objetivos[]" value="'.$reg->idobjetivo.'"></td></tr>';
    }