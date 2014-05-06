<?php
    require_once "../../models/objetivo.model.php";
        $objObjetivo = new Objetivo();
        
    $objetivo = $_GET["objetivo"];

    $query_objetivo_area_afectada = $objObjetivo->ConsultarAreaAfectada($objetivo);
    $i = 1;
    while($reg = $query_objetivo_area_afectada->fetchObject()){
        echo '<tr><td>'.$i.'</td><td>'.$reg->nombre.'</td><td><a href="#" class="areaAfectada" data-objetivo="'.$reg->idobjetivo.'" data-area="'.$reg->idarea.'">Quitar</a></td></tr>';
        $i++;
    }
?>

<script>
    $("a.areaAfectada").click(function(e){
        e.preventDefault()
        
        $.post("./ajax/inicio/objetivo_area_afectada_eliminar.ajax.php", { objetivo: $(this).attr('data-objetivo'), area : $(this).attr('data-area') }, function(r){
            console.log(r);
            ObjetivoAreasAfectadasConsultar();
        });
    });
</script>