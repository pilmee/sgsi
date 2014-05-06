<?php
    
    require_once "../../models/suministrador.model.php";
        $objSuministrador = new Suministrador();

    $query_suministrador = $objSuministrador->ConsultarSuministradores();
    $i = 1;
    $pag = $_GET["pag"];
    while($reg = $query_suministrador->fetchObject())
    {                        	
        if($reg->estado){ $est = "Alta"; }else{ $est = "Baja"; }                        	
        echo '<tr><td>'.$i.'</td><td>'.$reg->RUC.'</td><td><a href="?pag='.$pag.'&suministrador='.$reg->idsuministrador.'">'.$reg->razon_social.'</a></td><td>'.$reg->detalle.'</td><td>'.$est.'</td><td>'.$reg->descripcion.'</td><td><input type="checkbox" name="suministradores[]" value="'.$reg->idsuministrador.'"></td></tr>';
        $i++;
    }