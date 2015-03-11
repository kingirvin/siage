<?php
    if(class_exists('Constantes') === false or !class_exists('Constantes'))
    {
        include_once('Constantes.php');
    }
    header("Content-Type: text/html;charset=utf-8");
    header("Content-type: application/json");
    $Metodo = $_SERVER["REQUEST_METHOD"];
    $postss=$_POST;
    $postss['Imagenes'] = SubirFiles($postss, $_FILES);
    RegistrarData($postss,$_REQUEST["Modulo"], $_REQUEST["Accion"]);
    function SubirFiles($data=array(), $files = array())
    {
        $root = realpath($_SERVER["DOCUMENT_ROOT"]);
        $file_base = array();
        //print_r($files);
        foreach ($files as $key => $value) 
        {       
            if(is_uploaded_file($value['tmp_name'])) 
            {
                $sourcePath = $value['tmp_name'];
                $targetPath =$root.Constantes::Path."/Vista/Imagenes/".basename($data['Nombre']).".jpg";
                if(copy($sourcePath,$targetPath))
                { 
                   //echo $sourcePath ."+++ ".$targetPath." ". $value['size'];
                }
            }
            $file_base[$key]=$value;
        }
        return $file_base;
    }
    function RegistrarData($data = array(),$Modulo,$Accion)
    {
        $root = realpath($_SERVER["DOCUMENT_ROOT"]);
        if (file_exists($root.Constantes::Path."/Modelo/".$Modulo. ".php"))
        {
            require_once($root.Constantes::Path."/Modelo/".$Modulo. ".php");
            $Nombre_Clase = "Modelo".ucfirst(strtolower($Modulo));
            $Modelo = new $Nombre_Clase();
            $resultado = $Modelo->{$Accion}($data);
            if(is_array($resultado))
            {
                $arr = $resultado;
               // echo json_encode($resultado);            
            }
            else
            {
                //echo $resultado;
            }
        }
        else
        {
            echo "no existe";
        }
    }
?>