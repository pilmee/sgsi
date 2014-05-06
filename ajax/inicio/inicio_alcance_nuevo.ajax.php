<?php
    require_once "../../models/inicio_alcance.model.php";
        $objInicioAlcance = new InicioAlcance();
    
    date_default_timezone_set('America/Lima');
    $fecha = date("d_m_Y_h_i_s");
        
    $acta = $_POST["cboActaReunion"];
    $nombre = strip_tags(trim($_POST["txtInicioAlcanceNombre"]));
    $alcance = strip_tags(trim($_POST["txtInicioAlcanceAlcance"]));
    $descripcion = strip_tags(trim($_POST["txtInicioAlcanceDescripcion"]));
    $sg = $_POST["cboInicioAlcanceSG"];
    
    $exclusion = strip_tags(trim($_POST["txtInicioAlcanceExclusion"]));
    $organigrama = strip_tags(trim($_POST["txtInicioAlcanceUbicacionOrganigrama"]));
    $diagrama = strip_tags(trim($_POST["txtInicioAlcanceUbicacionDiagrama"]));
    
    /**
     *  UPLOAD DIAGRAMA
     */
    /*
    $PATH_DESTINO = "../../upload/";
    
        if(isset($_FILES["txtInicioAlcanceDiagramaFile"]["archivo"]) && ($_FILES["txtInicioAlcanceDiagramaFile"]["error"] == UPLOAD_ERR_OK)){
            move_uploaded_file($_FILES["txtInicioAlcanceDiagramaFile"]["tmp_name"], $PATH_DESTINO.$_FILES["txtInicioAlcanceDiagramaFile"]["name"]);
        }
    */
    $PATH_DESTINO = "../../upload/";
    
    $archivo_organigrama_nombre = $_FILES["txtInicioAlcanceOrganigramaFile"]["name"];
    $archivo_organigrama_tipo = $_FILES["txtInicioAlcanceOrganigramaFile"]["type"];
    $archivo_organigrama_peso = $_FILES["txtInicioAlcanceOrganigramaFile"]["size"];
    $archivo_organigrama_error = $_FILES["txtInicioAlcanceOrganigramaFile"]["error"];
    $archivo_organigrama_nombre_temporal = $_FILES["txtInicioAlcanceOrganigramaFile"]["tmp_name"];
    $archivo_organigrama_detalle = strip_tags(trim($_POST["txtInicioAlcanceOrganigramaText"]));
    
    $archivo_diagrama_nombre = $_FILES["txtInicioAlcanceDiagramaFile"]["name"];
    $archivo_diagrama_tipo = $_FILES["txtInicioAlcanceDiagramaFile"]["type"];
    $archivo_diagrama_peso = $_FILES["txtInicioAlcanceDiagramaFile"]["size"];
    $archivo_diagrama_error = $_FILES["txtInicioAlcanceDiagramaFile"]["error"];
    $archivo_diagrama_nombre_temporal = $_FILES["txtInicioAlcanceDiagramaFile"]["tmp_name"];
    $archivo_diagrama_detalle = strip_tags(trim($_POST["txtInicioAlcanceDiagramaText"]));
    
    
    $archivo_organigrama_nombre = str_replace(" ","_",$archivo_organigrama_nombre);
    $archivo_diagrama_nombre = str_replace(" ","_",$archivo_diagrama_nombre);
    
    if($archivo_organigrama_error == 0){
        if(move_uploaded_file($archivo_organigrama_nombre_temporal, $PATH_DESTINO.'O_'.$fecha.'__'.$archivo_organigrama_nombre)){
            if($objInicioAlcance->AgregarArchivo("organigrama", 'O_'.$fecha.'__'.$archivo_organigrama_nombre, obtenerExtensionFichero($archivo_organigrama_nombre), $archivo_organigrama_peso, $archivo_organigrama_detalle, $acta)){
                echo "Se agrego un archivo a organigrama\n";
            }   
        }else{
            echo "El Organigrama no a podido ser cargado en el servidor.\n";
        }
    }
    if($archivo_diagrama_error == 0){
        if(move_uploaded_file($archivo_diagrama_nombre_temporal, $PATH_DESTINO.'D_'.$fecha.'__'.$archivo_diagrama_nombre)){
            if($objInicioAlcance->AgregarArchivo("diagrama", 'D_'.$fecha.'__'.$archivo_diagrama_nombre, obtenerExtensionFichero($archivo_diagrama_nombre), $archivo_diagrama_peso, $archivo_diagrama_detalle, $acta)){
                echo "Se agrego un archivo a diagrama\n";
            }        
        }else{
            echo "El Diagrama no ha podido ser cargado en el servidor.\n";
        }
    }
    //var_dump($_FILES);
    //var_dump($_FILES);
    //var_dump($_POST);
    
    //var_dump($_POST["txtInicioAlcanceDiagramaFile"]);
    
    if($objInicioAlcance->ActualizarInicioAlcance($acta,$nombre,$alcance,$descripcion,$sg,$exclusion,$organigrama,$diagrama)){
        echo "La informacion del inicio y alcance del acta a sido actualizada";
    }else{
        echo "La informacion del inicio y alcance del acta no ha sido actualizada";
    }
    
    
    
    
    
    
    function obtenerExtensionFichero($str){
        $ext = explode(".", $str);
        $ext = end($ext);
        return $ext;
    }
