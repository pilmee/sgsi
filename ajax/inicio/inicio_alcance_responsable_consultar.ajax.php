<?php
    require_once "../../models/inicio_alcance.model.php";
        $objInicioAlcance = new InicioAlcance();
        
    $acta = $_GET["acta"];

    $query_responsable = $objInicioAlcance->ConsultarResponsables($acta);
    $i = 1;
    while($reg = $query_responsable->fetchObject()){
        echo '<tr><td>'.$i.'</td><td>'.$reg->apellidos.' '.$reg->nombres.'</td><td><a href="#" class="comite" data-acta="'.$reg->idacta_reunion.'" data-empleado="'.$reg->idempleado.'">Quitar</a></td></tr>';
        $i++;
    }
?>

<script>
    $("a.comite").click(function(e){
        e.preventDefault()
        $.post("./ajax/inicio/inicio_alcance_responsable_eliminar.ajax.php", { acta: $(this).attr('data-acta'), empleado : $(this).attr('data-empleado') }, function(r){
            console.log(r);
            InicioAlcanceConsultarResponsable();
        });
    });
</script>