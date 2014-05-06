<?php
    require_once "../../models/inicio_alcance.model.php";
        $objInicioAlcance = new InicioAlcance();
        
    $acta = $_GET["acta"];

    $query_comite = $objInicioAlcance->ConsultarComite($acta);
    $i = 1;
    while($reg = $query_comite->fetchObject()){
        echo '<tr><td>'.$i.'</td><td>'.$reg->nombre.'</td><td><a href="#" class="comite" data-acta="'.$reg->idinicio_alcance.'" data-cargo="'.$reg->idcargo.'">Quitar</a></td></tr>';
        $i++;
    }
?>

<script>
    $("a.comite").click(function(e){
        e.preventDefault()
        $.post("./ajax/inicio/inicio_alcance_comite_eliminar.ajax.php", { acta: $(this).attr('data-acta'), cargo : $(this).attr('data-cargo') }, function(r){
            console.log(r);
            InicioAlcanceConsultarComite();
        });
    });
</script>