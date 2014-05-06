<?php
    require_once "../../models/objetivo.model.php";
        $objObjetivo = new Objetivo();
        
    $objetivo = $_GET["objetivo"];

    $query_objetivo_especifico = $objObjetivo->ConsultarObjetivoEspecifico($objetivo);
    $i = 1;
    while($reg = $query_objetivo_especifico->fetchObject()){
        echo '<tr><td>'.$i.'</td><td>'.$reg->objetivo_nombre.'</td><td>'.$reg->descripcion.'</td><td>'.$reg->apellidos.' '.$reg->nombres.'</td><td>'.$reg->recursos.'</td><td><a href="#" class="objetivo-especifico" data-objetivo="'.$reg->idobjetivo_especifico.'" >Quitar</a></td></tr>';
        $i++;
    }
?>

<script>
    $("a.objetivo-especifico").click(function(e){
        e.preventDefault()
        
        $.post("./ajax/inicio/objetivo_objetivo_especifico_eliminar.ajax.php", { objetivo: $(this).attr('data-objetivo') }, function(r){
            console.log(r);
            ObjetivoEspecificoConsultar();
        });
    });
</script>