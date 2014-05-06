<?php
    require_once "../../models/inicio_alcance.model.php";
        $objInicioAlcance = new InicioAlcance();
        
    $acta = $_GET["acta"];

    $query_interface = $objInicioAlcance->ConsultarInterfaces($acta);
    $i = 1;
    while($reg = $query_interface->fetchObject()){
        echo '<tr><td>'.$i.'</td><td>'.$reg->nombre.'</td><td><a href="#" class="interface" data-acta="'.$reg->idacta_reunion.'" data-cargo="'.$reg->idcargo.'">Quitar</a></td></tr>';
        $i++;
    }
?>

<script>
    $("a.interface").click(function(e){
        e.preventDefault()
        $.post("./ajax/inicio/inicio_alcance_interface_eliminar.ajax.php", { acta: $(this).attr('data-acta'), cargo : $(this).attr('data-cargo') }, function(r){
            console.log(r);
            InicioAlcanceConsultarInterface();
        });
    });
</script>