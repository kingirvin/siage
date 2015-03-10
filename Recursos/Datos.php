<?php
if(class_exists('Constantes') === false or !class_exists('Constantes'))
{
    include_once('Constantes.php');
}
header("Content-Type: text/html;charset=utf-8");
header("Content-type: application/json");
$Metodo = $_SERVER["REQUEST_METHOD"];
$request_vars = Array();
parse_str(file_get_contents('php://input'), $request_vars );
$Modulo = $_REQUEST["Modulo"];
$Accion = $_REQUEST["Accion"];
$Pagina = $_REQUEST["Pagina"];
$Tamaño = $_REQUEST["Size"];
$Inicio = (((int)$Pagina) - 1) * ((int)$Tamaño);
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
//print_r($request_vars);
if (file_exists($root.Constantes::Path."/Modelo/".$Modulo. ".php"))
{
    require_once($root.Constantes::Path."/Modelo/".$Modulo. ".php");
    $Nombre_Clase = "Modelo".ucfirst(strtolower($Modulo));
    $Modelo = new $Nombre_Clase();
    $resultado = $Modelo->{$Accion}($request_vars);
   if(is_array($resultado))
    {
        $cantidad;
        if (isset($Modelo->total)) {
            if ($Modelo->total!=0) {
                $cantidad = $Modelo->total;
            }else
                $cantidad = count($resultado);
        }else
            $cantidad = count($resultado);
        $arr = $resultado;
        echo "{\"total\":" .$cantidad. ", \"data\":" .json_encode($resultado). "}";    
    }
    else
    {
        echo $resultado;
    }
}
else
{
    echo "no existe";
}
?>