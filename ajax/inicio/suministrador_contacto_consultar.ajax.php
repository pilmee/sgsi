<?php   
    require_once "../../models/suministrador.model.php";
        $objSuministrador = new Suministrador();

    $suminitrador = $_GET["suministrador"];
    $query = $objSuministrador->ConsultarContacto($suminitrador);
    $i = 1;

    while($reg = $query->fetchObject()){
    	echo '<tr><td>'.$i.'</td><td>'.$reg->nombre.'</td><td>'.$reg->cargo.'</td><td>'.$reg->telefono.'</td><td>'.$reg->email.'</td>
    	      <td>'.$reg->comentario.'</td><td><a href="#" class="elementoContacto" data-id="'.$reg->idcontacto.'">Quitar</a></td></tr>';
    	$i++;
    }

?>
<script>
    $("a.elementoContacto").click(function(e){
        e.preventDefault()
        $.post("./ajax/inicio/suminitrador_contacto_eliminar.ajax.php", { id: $(this).attr('data-id') }, function(r){
            console.log(r);
            SuministradorContactoConsultar();
        });
    });
</script>