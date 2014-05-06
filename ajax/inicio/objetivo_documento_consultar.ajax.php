<?php
    $objetivo = $_GET["objetivo"];
    
    require_once "../../models/objetivo.model.php";
        $objObjetivo = new Objetivo();
    
    $query_documentos = $objObjetivo->ConsultarDocumentos($objetivo);    
    
    
    $i = 1;
    while($reg = $query_documentos->fetchObject()){
        //var_dump($reg);
        echo "<tr><td>$i</td><td><a href='./upload/".$reg->documento."'>".$reg->documento."</a></td><td>".$reg->extension."</td><td>".$reg->fecha."</td><td>".$reg->descripcion."</td><td><a href='#' class='doc' data-objetivo='".$reg->idobjetivo_documentos."'>Quitar</a></td></tr>";
        $i++;
    }
    
?>

<script>
    $("a.doc").click(function(e){
        e.preventDefault()
        $.post("./ajax/inicio/objetivo_documento_eliminar.ajax.php", { objetivo: $(this).attr('data-objetivo') }, function(r){
            console.log(r);
            ObjetivoDocumentosFileConsultar();
        });
    });
</script>