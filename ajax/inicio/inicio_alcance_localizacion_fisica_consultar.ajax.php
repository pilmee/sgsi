<?php
    require_once "../../models/inicio_alcance.model.php";
        $objInicioAlcance = new InicioAlcance();
        
    $acta = $_GET["acta"];

    $query_localizacionFisica = $objInicioAlcance->ConsultarLocalizacionFisica($acta);
    $i = 1;
    while($reg = $query_localizacionFisica->fetchObject()){
        echo '<tr><td>'.$i.'</td><td>'.$reg->nombre.'</td><td><a href="#" class="localizacion" data-acta="'.$reg->idacta_reunion.'" data-area="'.$reg->idarea.'">Quitar</a></td></tr>';
        $i++;
    }
?>

<script>
    $("a.localizacion").click(function(e){
        e.preventDefault()
        $.post("./ajax/inicio/inicio_alcance_localizacion_fisica_eliminar.ajax.php", { acta: $(this).attr('data-acta'), area : $(this).attr('data-area') }, function(r){
            console.log(r);
            InicioAlcanceConsultarLocalizacionFisica();
        });
    });
</script>