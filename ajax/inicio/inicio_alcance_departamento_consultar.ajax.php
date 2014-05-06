<?php
    require_once "../../models/inicio_alcance.model.php";
        $objInicioAlcance = new InicioAlcance();
        
    $acta = $_GET["acta"];

    $query_departamentos = $objInicioAlcance->ConsultarDepartamentos($acta);
    $i = 1;
    while($reg = $query_departamentos->fetchObject()){
        echo '<tr><td>'.$i.'</td><td>'.$reg->nombre.'</td><td><a href="#" class="comite" data-acta="'.$reg->idacta_reunion.'" data-departamento="'.$reg->iddepartamento.'">Quitar</a></td></tr>';
        $i++;
    }
?>

<script>
    $("a.comite").click(function(e){
        e.preventDefault()
        $.post("./ajax/inicio/inicio_alcance_departamento_eliminar.ajax.php", { acta: $(this).attr('data-acta'), departamento : $(this).attr('data-departamento') }, function(r){
            console.log(r);
            InicioAlcanceConsultarDepartamento();
        });
    });
</script>