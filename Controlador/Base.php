<?php
require_once('Modelo/Login.php');
if(class_exists('Constantes') === false or !class_exists('Constantes'))
    include_once('Recursos/Constantes.php');

abstract class ControladorBase 
{    
    protected $URL;
    protected $Accion;
    protected $Modelo;
    protected $Login;
    //Scripts
    protected $Estilo='';
    protected $Script='';
    //Vistas
    protected $Header='';
    protected $Slider='';
    protected $Aside='';
    protected $Contenido='';
    protected $Footer='';
    
    //obtener las funciones
    public function __construct($action, $id, $urlValues)
    {
        $this->Login = new ModeloLogin();
        $this->Accion = $action;
        $this->URL = $urlValues;
        $this->ID = $id;    
    }
        
    //Ejecutamos la accion a realizar
    public function ejecutarAccion() 
    {
        return $this->{$this->Accion}();
    }

    //PAGINA
    public function MostarElementos($js='', $css='')
    {
        //Base HTML
        $pagina = $this->Auxiliares(file_get_contents('Vista/Base.html'), $js, $css);
        
        //Contenido HTML
        $pagina = preg_replace('/\#HEADER\#/ms', $this->Header, $pagina);
        $pagina = preg_replace('/\#SLIDER\#/ms', $this->Slider, $pagina);
        $pagina = preg_replace('/\#ASIDE\#/ms', $this->Aside, $pagina);
        $pagina = preg_replace('/\#CONTENIDO\#/ms', $this->Contenido, $pagina);
        $pagina = preg_replace('/\#FOOTER\#/ms', $this->Footer, $pagina);

        return $this->Ruta($pagina);
    }

    private function Ruta($pagina)
    {
        $diccionario_ruta = array('{elemento_ruta}'=>Constantes::Path); 
        return str_replace(array_keys($diccionario_ruta), array_values($diccionario_ruta), $pagina);        
    }
    public function ComprobarLogin()
    {
        if(!$this->Login->EstadoLogin()) 
        {
            header("Location: http://". $_SERVER['HTTP_HOST'].Constantes::Path."/Login/Principal" );
            exit;
        }
    }

    private function Auxiliares($html, $js, $css)
    {
        $aux = array();

        $js_aux='';
        if(is_array($js))
        {
            foreach ($js as $key => $value)             
                $js_aux.="<script src='{elemento_ruta}/Vista/JS/".$value.".js'></script>";
            
        }
        else if(!empty($js))        
            $js_aux="<script src='{elemento_ruta}/Vista/JS/".$js.".js'></script>";
        

        $css_aux='';        
        if(is_array($css))
        {
            foreach ($css as $key => $value)             
                $css_aux.="<link href='{elemento_ruta}/Vista/CSS/".$value.".css' rel='stylesheet' />";            
        }
        else if(!empty($css))        
            $css_aux="<link href='{elemento_ruta}/Vista/CSS/".$css.".css' rel='stylesheet' />";       

        $diccionario_elemento = array('{elemento_script}'=>$js_aux,
                                      '{elemento_estilo}'=>$css_aux); 

        return str_replace(array_keys($diccionario_elemento), array_values($diccionario_elemento), $html);
    } 
}

?>
