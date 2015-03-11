<?php

require_once('Base.php');

class ControladorLogin extends ControladorBase

{    

    public function __construct($action, $id, $urlValues) 

    {

        parent::__construct($action, $id, $urlValues);     

    }   

    protected function Principal()

    {   

        $diccionario_ruta = array('{elemento_ruta}'=>Constantes::Path);  

        $this->Header = $this->header(file_get_contents("Vista/Secciones/Header.html"));

        $this->Slider = file_get_contents("Vista/Secciones/Slider.html");

        $this->Contenido = file_get_contents("Vista/Contenido/Login.html");

        $this->Footer = file_get_contents("Vista/Secciones/Footer.html");       

        if(count($_POST))

        {            

            if($this->Login->ValidarLogin($_POST['Usuario'], $_POST['Password']))

            {

               // echo $_POST['Usuario'];

                header("Location: http://". $_SERVER['HTTP_HOST'].Constantes::Path."/Inicio/Siaga" );

                exit;

            }

            else

            {

                $diccionario_login = array('{elemento_login}'=>'Usuario o Contraseña Incorrectos');                 

            }         

        }

        else

        {     

            $diccionario_login = array('{elemento_login}'=>'Ingrese Usuario y Contraseña');                        

        }         

        $this->Contenido= str_replace(array_keys($diccionario_login), array_values($diccionario_login), $this->Contenido); 

        $html = $this->MostarElementos('','Login');

        print $html;      

    }

    protected function Logout()

    {

        $this->Login->Salir();

        header("Location: http://". $_SERVER['HTTP_HOST'].Constantes::Path."/Login/Principal" );

        exit;

    }

    public function header($vista)

    {

        //echo "string";

        if(!$this->Login->EstadoLogin())

        {

            $lista="<div class='contact pull-right'>                               

                    <p class='email'><i class='fa fa-envelope'></i><a href='{elemento_ruta}/Login/Principal'>Iniciar Sesion</a></p>

                    </div>";            

            $cambio = array('{lista}'=>$lista);

            return str_replace(array_keys($cambio), array_values($cambio), $vista);

        }

        else

        {

            $Nombre=$this->Login->GetNombre();

            $lista="<div class='contact pull-right'>                

                <p class='sesion-usuario phone'>Bienvido ".$Nombre."</p> 

                <p class='email'><a href='{elemento_ruta}/Login/Logout'>Cerrar Sesion</a></p>

            </div>";               

            $cambio = array('{lista}'=>$lista);

            return str_replace(array_keys($cambio), array_values($cambio), $vista);

        }

    } 

}

?>