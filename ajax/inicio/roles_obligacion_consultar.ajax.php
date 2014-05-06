<?php

    require_once "../../models/cargo.model.php";
        $objCargo = new Cargo();
        
    $empresa = $_GET["empresa"];
    
    $query_obligacion = $objCargo->ConsultarObligacion($empresa);
    $i = 1;
    while($reg = $query_obligacion->fetchObject()){
        echo '<tr><td>'.$i.'</td><td>'.$reg->detalle.'</td><td>'.$reg->nombre.'</td><td><a href="#" class="obligacion" data-obligacion="'.$reg->idobligacion.'">Quitar</a></td></tr>';
        $i++;
    }
    
?>
<script>
    $("a.obligacion").click(function(e){
        e.preventDefault()
        
        $.post("./ajax/inicio/roles_obligacion_eliminar.ajax.php", { obligacion: $(this).attr('data-obligacion') }, function(r){
            console.log(r);
            ConsultarRolesFunciones();
        });
    });
</script>