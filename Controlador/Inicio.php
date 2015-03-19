<?php



require_once('Base.php');



class ControladorInicio extends ControladorBase

{

    //add to the parent constructor

    public function __construct($action, $id, $urlValues) 

    {

        parent::__construct($action, $id, $urlValues);//llama al construc de la base controlbase

    }

        

    protected function Principal()//La accion por defecto para inicio (si no se envian parametros)

    {

        $this->ComprobarLogin();
        require_once("Modelo/Accion.php");

        $Accion = new ModeloAccion(); 

        $diccionario_ruta = array('{elemento_ruta}'=>Constantes::Path);  

        $this->Header = $this->header(file_get_contents("Vista/Secciones/Header.html"));

        $this->Slider = file_get_contents("Vista/Secciones/Slider.html");

        $this->Aside=$this->Lista_Accion(file_get_contents("Vista/Contenido/Aside.html"),$Accion);

        $this->Contenido = file_get_contents("Vista/Contenido/Inicio.html");

        $this->Footer = file_get_contents("Vista/Secciones/Footer.html");



        $pagina = $this->MostarElementos('',''); 

        print $pagina;

    }

    protected function siaga()//La accion por defecto para inicio (si no se envian parametros)

    {

        require_once("Modelo/Accion.php");

        $Accion = new ModeloAccion(); 

        require_once("Modelo/Persona.php");

        $Persona = new ModeloPersona();

        $this->ComprobarLogin();

        $diccionario_ruta = array('{elemento_ruta}'=>Constantes::Path);  

        $this->Header = $this->header(file_get_contents("Vista/Secciones/Header.html"));

        $this->Slider = file_get_contents("Vista/Secciones/Slider.html");

        $this->Aside=$this->Lista_Accion(file_get_contents("Vista/Contenido/Aside.html"),$Accion);

        $this->Contenido = file_get_contents("Vista/Contenido/Inicio.html");

        $this->Footer = file_get_contents("Vista/Secciones/Footer.html");



        $pagina = $this->MostarElementos('',''); 

        print $pagina;

    }//RegistrarDocente

    public function RegistrarDocente()

    {

        require_once("Modelo/Accion.php");

        $Accion = new ModeloAccion(); 

        require_once("Modelo/Persona.php");

        $Persona = new ModeloPersona();

        $this->ComprobarLogin();

        $diccionario_ruta = array('{elemento_ruta}'=>Constantes::Path);  

        $this->Header = $this->header(file_get_contents("Vista/Secciones/Header.html"));

        $this->Slider = file_get_contents("Vista/Secciones/Slider.html");

        $this->Aside = $this->Lista_Accion(file_get_contents("Vista/Contenido/Aside.html"),$Accion);;

        $this->Contenido = file_get_contents("Vista/Contenido/Mantenimiento/RegistroDocente.html");

        $this->Footer = file_get_contents("Vista/Secciones/Footer.html");

        //js -css

        $jss = array('RegistroDocente');

        $css = array('RegistroDocente');

        $pagina = $this->MostarElementos($jss,$css); 

        print $pagina;

    }

    public function Periodo()

    {

        require_once("Modelo/Accion.php");

        $Accion = new ModeloAccion(); 

        require_once("Modelo/Persona.php");

        $Persona = new ModeloPersona();

        $this->ComprobarLogin();

        $diccionario_ruta = array('{elemento_ruta}'=>Constantes::Path);  

        $this->Header = $this->header(file_get_contents("Vista/Secciones/Header.html"));

        $this->Slider = file_get_contents("Vista/Secciones/Slider.html");

        $this->Aside = $this->Lista_Accion(file_get_contents("Vista/Contenido/Aside.html"),$Accion);;

        $this->Contenido = file_get_contents("Vista/Contenido/Mantenimiento/Periodo.html");

        $this->Footer = file_get_contents("Vista/Secciones/Footer.html");

        //js -css

        $jss = array('Periodo');

        $css = array('Periodo');

        $pagina = $this->MostarElementos($jss,$css); 

        print $pagina;

    }

    public function RegistrarNotas()

    {

        require_once("Modelo/Accion.php");

        $Accion = new ModeloAccion(); 

        require_once("Modelo/Persona.php");

        $Persona = new ModeloPersona();

        $this->ComprobarLogin();

        $diccionario_ruta = array('{elemento_ruta}'=>Constantes::Path);  

        $this->Header = $this->header(file_get_contents("Vista/Secciones/Header.html"));

        $this->Slider = file_get_contents("Vista/Secciones/Slider.html");

        $this->Aside = $this->Lista_Accion(file_get_contents("Vista/Contenido/Aside.html"),$Accion);;

        $this->Contenido = $this->RegistroNotas(file_get_contents("Vista/Contenido/Mantenimiento/RegistrarNotas.html"),$Persona);

        $this->Footer = file_get_contents("Vista/Secciones/Footer.html");

        //js -css

        $jss = array('RegistrarNotas');

        $css = array('RegistrarNotas');

        $pagina = $this->MostarElementos($jss,$css); 

        print $pagina;

    }

    public function MantenimientoCursoCarrera()

    {

        require_once("Modelo/Accion.php");

        $Accion = new ModeloAccion(); 

        require_once("Modelo/Persona.php");

        $Persona = new ModeloPersona();

        $this->ComprobarLogin();

        $diccionario_ruta = array('{elemento_ruta}'=>Constantes::Path);  

        $this->Header = $this->header(file_get_contents("Vista/Secciones/Header.html"));

        $this->Slider = file_get_contents("Vista/Secciones/Slider.html");

        $this->Aside = $this->Lista_Accion(file_get_contents("Vista/Contenido/Aside.html"),$Accion);;

        $this->Contenido = file_get_contents("Vista/Contenido/Mantenimiento/MantenimientoCurso.html");

        $this->Footer = file_get_contents("Vista/Secciones/Footer.html");

        //js -css

        $jss = array('MantenimientoCurso');

        $css = array('MantenimientoCurso');



        $pagina = $this->MostarElementos($jss,$css); 

        print $pagina;

    }

     protected function Matricula()//La accion por defecto para inicio (si no se envian parametros)

    {

        require_once("Modelo/Accion.php");

        $Accion = new ModeloAccion(); 

        require_once("Modelo/Persona.php");

        $Persona = new ModeloPersona();

        $this->ComprobarLogin();

        $diccionario_ruta = array('{elemento_ruta}'=>Constantes::Path);  

        $this->Header = $this->header(file_get_contents("Vista/Secciones/Header.html"));

        $this->Slider = file_get_contents("Vista/Secciones/Slider.html");

        $this->Aside=$this->Lista_Accion(file_get_contents("Vista/Contenido/Aside.html"),$Accion);;

        $this->Contenido = file_get_contents("Vista/Contenido/Matricula.html");

        $this->Footer = file_get_contents("Vista/Secciones/Footer.html");

        //js -css

        $jss = array('Matricula');

        $css = array('Matricula');



        $pagina = $this->MostarElementos($jss,$css); 

        print $pagina;

    }

    public function RegistroNotas($Vista,$datos)

    {

        $DNI=$this->Login->GetTipoDNI();        

        $vars = array('DNI'=> $DNI);      

        $res = $datos->BuscarDocente($vars);       

        $indicadores = "";    

        foreach ($res as $Fila) 

        {             

            $indicadores .= "<div class='datos-docente form-group'>

                                <input type='hidden' id='CodigoAlumno' name='CodigoAlumno' value='".$Fila['idtUsuario']."'>

                                <label for='name' class='col-sm-9 control-label'>Docente : ".$Fila['Nombre']." ".$Fila['Apellido']."</label>

                            </div>";

        }

        $diccionario_elemento = array('{elemento_docente}'=>$indicadores); 

        //$Vista = str_replace(array_keys($diccionario_elemento), array_values($diccionario_elemento), $Vista);

        return str_replace(array_keys($diccionario_elemento), array_values($diccionario_elemento), $Vista);

        //echo $Vista;

    }

    /*

    <div class="datos-docente form-group">

        <input type="hidden" id="CodigoAlumno" name="CodigoAlumno" value="">

        <label for="name" class="col-sm-9 control-label">Carrera Profecional : Sistemas</label>

    </div>

    */

   public function header($vista)

    {

       // echo "string";

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



    public function Lista_Accion($Vista,$datos)

    {

        $idTipo_usuario=$this->Login->GetTipoUsuario();                   

        $vars = array('idTipo_usuario'=> $idTipo_usuario);      

        $res = $datos->BuscarAccion($vars);



        $indicadores = "";    

        foreach ($res as $Fila) 

        {             

            $indicadores .= "<a href='{elemento_ruta}/Inicio/".$Fila["Nombre"]."' class='list-group-item'>".$Fila["Accion"]."</a>";

        }

        $diccionario_elemento = array('{lista_modulos}'=>$indicadores); 

        //$Vista = str_replace(array_keys($diccionario_elemento), array_values($diccionario_elemento), $Vista);

        return str_replace(array_keys($diccionario_elemento), array_values($diccionario_elemento), $Vista);

        //echo $Vista;

    }     

}

?>