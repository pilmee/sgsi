<?php   
    require_once "../../models/suministrador.model.php";
        $objSuministrador = new Suministrador();

    $suminitrador = $_GET["suministrador"];
    $query = $objSuministrador->ConsultarSLA($suminitrador);
    $i = 1;
    while($reg = $query->fetchObject()){
        //var_dump($reg);
    	echo '<tr><td>'.$i.'</td><td>'.$reg->nombre.'</td><td>'.$reg->descripcion.'</td>
    	      <td><a href="#" class="elementoSLA" data-id="'.$reg->idsla.'">Quitar</a></td></tr>';
    	$i++;
    }

?>
<script>
    $("a.elementoSLA").click(function(e){
        e.preventDefault()
        $.post("./ajax/inicio/suminitrador_sla_eliminar.ajax.php", { id: $(this).attr('data-id') }, function(r){
            console.log(r);
            SuministradorSLAConsultar();
        });
    });
</script>