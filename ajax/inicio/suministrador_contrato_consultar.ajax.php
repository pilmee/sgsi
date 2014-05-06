<?php   
    require_once "../../models/suministrador.model.php";
        $objSuministrador = new Suministrador();

    $suminitrador = $_GET["suministrador"];
    $query = $objSuministrador->ConsultarContrato($suminitrador);
    $i = 1;

    while($reg = $query->fetchObject()){
    	echo '<tr><td>'.$i.'</td><td>'.$reg->detalle.'</td><td>'.$reg->inicio.'</td><td>'.$reg->fin.'</td><td>'.$reg->soporte.'</td>
    	      <td><a href="#" class="elementoContrato" data-id="'.$reg->idcontrato.'">Quitar</a></td></tr>';
    	$i++;
    }

?>
<script>
    $("a.elementoContrato").click(function(e){
        e.preventDefault()
        $.post("./ajax/inicio/suminitrador_contrato_eliminar.ajax.php", { id: $(this).attr('data-id') }, function(r){
            console.log(r);
            SuministradorContratoConsultar();
        });
    });
</script>