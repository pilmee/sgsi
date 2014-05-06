<?php
    $archivo = $_GET["archivo"];
    $acta = $_GET["acta"];
    
    require_once "../../models/inicio_alcance.model.php";
        $objInicioAlcance = new InicioAlcance();
    
    $query = "";    
    
    switch($archivo){
        case "organigrama": $query = $objInicioAlcance->ConsultarArchivo("organigrama",$acta);
            break;
        case "diagrama":    $query = $objInicioAlcance->ConsultarArchivo("diagrama",$acta);
            break;
    }
    
    $i = 1;
    while($reg = $query->fetchObject()){
        //var_dump($reg);
        echo "<tr><td>$i</td><td><a href='./upload/".$reg->archivo."'>".$reg->archivo."</a></td><td>".$reg->extension."</td><td>".$reg->fecha."</td><td>".$reg->descripcion."</td><td><a href='#' class='file' data-acta='".$reg->idacta_reunion."' data-tipo='".$archivo."'>Quitar</a></td></tr>";
        $i++;
    }
    
?>

<script>
    $("a.file").click(function(e){
        e.preventDefault()
        $.post("./ajax/inicio/inicio_alcance_archivo_eliminar.ajax.php", { acta: $(this).attr('data-acta'), tipo : $(this).attr('data-tipo') }, function(r){
            console.log(r);
            InicioAlcanceConsultarOrganigramas();
            InicioAlcanceConsultarDiagramas();
        });
    });
</script>