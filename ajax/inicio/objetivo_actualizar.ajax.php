<?php
    require_once "../../models/objetivo.model.php";
        $objObjetivo = new Objetivo();
    
    date_default_timezone_set('America/Lima');
    $fecha_file = date("d_m_Y_h_i_s");
    
    $objetivo_id = $_POST["txtIdObjetivo"];
    $objetivo = strip_tags(trim($_POST["txtObjetivo"]));
    $fecha = strip_tags(trim($_POST["txtFecha"]));
    $empleado = $_POST["cboResponsable"];
    $descripcion = strip_tags(trim($_POST["txtDescripcion"]));
    $documento_descripcion = strip_tags(trim($_POST["txtObjetivoDocumentosText"]));
    
    $PATH_DESTINO = "../../upload/";
        $documento_nombre = $_FILES["txtObjetivoDocumentosFile"]["name"];
        $documento_peso = $_FILES["txtObjetivoDocumentosFile"]["size"];
        $documento_tipo = $_FILES["txtObjetivoDocumentosFile"]["type"];
        $documento_error = $_FILES["txtObjetivoDocumentosFile"]["error"];
        $documento_nombre_temporal = $_FILES["txtObjetivoDocumentosFile"]["tmp_name"];
        
        $documento_nombre = str_replace(" ","_",$documento_nombre);
        
    //var_dump($documento_nombre);
    //var_dump($documento_nombre_temporal);
    if($documento_error == 0){
        $archivo_nuevo_nombre = 'OBJDOC_'.$fecha_file.'__'.$documento_nombre;
        if(move_uploaded_file($documento_nombre_temporal, $PATH_DESTINO.$archivo_nuevo_nombre)){
            if($objObjetivo->AgregarDocumento($objetivo_id, $archivo_nuevo_nombre, obtenerExtensionFichero($documento_nombre), $documento_peso, $documento_descripcion)){
                echo "Se agrego un archivo a documentos\n";
            }   
        }else{
            echo "El Documento no a podido ser cargado en el servidor.\n";
        }
    }
    
    //var_dump($_FILES);
    //var_dump($_POST);
    
    if($objObjetivo->ActualizarObjetivo($objetivo_id, $objetivo, $descripcion, $empleado)){
        echo "La informacion del Objetivo del Negocio a sido actualizada";
    }else{
        echo "La informacion del Objetivo del Negocio no ha podido ser actualizada";
    }
    
    
    function obtenerExtensionFichero($str){
        $ext = explode(".", $str);
        $ext = end($ext);
        return $ext;
    }