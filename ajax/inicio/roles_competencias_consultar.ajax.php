<?php

    require_once "../../models/cargo.model.php";
        $objCargo = new Cargo();
        
    $empresa = $_GET["empresa"];
    
    $query_competencia = $objCargo->ConsultarCompetencia($empresa);
    $i = 1;
    while($reg = $query_competencia->fetchObject()){
        echo '<tr><td>'.$i.'</td><td>'.$reg->detalle.'</td><td>'.$reg->nombre.'</td><td><a href="#" class="competencia" data-competencia="'.$reg->idcompetencia.'">Quitar</a></td></tr>';
        $i++;
    }
    
?>
<script>
    $("a.competencia").click(function(e){
        e.preventDefault()
        
        $.post("./ajax/inicio/roles_competencias_eliminar.ajax.php", { competencia: $(this).attr('data-competencia') }, function(r){
            console.log(r);
            ConsultarRolesCompetencias();
        });
    });
</script>