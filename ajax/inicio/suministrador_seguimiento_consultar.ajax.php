<?php   
    require_once "../../models/suministrador.model.php";
        $objSuministrador = new Suministrador();

    $suminitrador = $_GET["suministrador"];
    $query = $objSuministrador->ConsultarSeguimiento($suminitrador);
    $i = 1;

    while($reg = $query->fetchObject()){
    	echo '<tr>
                    <td>'.$i.'</td>
                    <td>'.$reg->usuario.'</td>
                    <td>'.$reg->fecha.'</td>
                    <td>'.$reg->descripcion.'</td>
    	           <td><a href="#" class="elementoSeguimiento" data-id="'.$reg->idseguimiento.'">Quitar</a></td>
                </tr>';
    	$i++;
        //var_dump($reg);
    }

?>
<script>
    $("a.elementoSeguimiento").click(function(e){
        e.preventDefault()
        $.post("./ajax/inicio/suminitrador_seguimiento_eliminar.ajax.php", { id: $(this).attr('data-id') }, function(r){
            console.log(r);
            SuministradorSeguimientoConsultar();
        });
    });
</script>