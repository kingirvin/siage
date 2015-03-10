<?php

require_once('Base.php');



class ModeloPersona extends ModeloBase

{

	function __construct() 

	{

		@session_start();

	}		

	//SELECT idcategoria, nombre FROM fuente.categoria	
	public function RegistrarDocente($vars)
	{	
		$this->consulta = "INSERT into tpersona(DNI,Nombre,Apellido,Telefono,Email,Direccion,Foto) 
						values(".$vars['DNI'].",'".$vars['Nombre']."','".$vars['Apellido']."',".$vars['Telefono'].",'".$vars['Email']."','".$vars['Direccion']."','".$vars['DNI']."');";
		$this->Ejecutar();
		$this->consulta = "INSERT into tdocente(DNI,Especialidad)
						values(".$vars['DNI'].",'".$vars['DNI']."');";
		$this->Ejecutar();
		$this->consulta = "INSERT into tusuario(idTipo_usuario,DNI,Nombre,Password,Estado)
						values(2,".$vars['DNI'].",'".$vars['Nombre']."','".$vars['DNI']."',1);";
		$this->Ejecutar();
		return "Datos Insertados";
	}

	public function Registrar($vars)
	{	
		$this->consulta = "INSERT into tpersona(DNI,Nombre,Apellido,Telefono,Email,Direccion,Foto) 
						values(".$vars['DNI'].",'".$vars['Nombre']."','".$vars['Apellido']."',".$vars['Telefono'].",'".$vars['Email']."','".$vars['Direccion']."','".$vars['DNI']."');";
		$this->Ejecutar();
		$this->consulta = "INSERT into testudiante(codigo,DNI,idCarrera,año_Ingreso,Año_egreso,Condicion)
						values('".$vars['Codigo']."',".$vars['DNI'].",'".$vars['Carrera']."','".$vars['Ingreso']."',".$vars['Egreso'].",'".$vars['Condicion']."');";
		$this->Ejecutar();
		$this->consulta = "INSERT into tusuario(idTipo_usuario,DNI,Nombre,Password,Estado)
						values(1,".$vars['DNI'].",'".$vars['Codigo']."','".$vars['DNI']."',1);";
		$this->Ejecutar();
		return "Datos Insertados";
	}	
	public function VerificarDNI($vars)
	{
		$this->consulta="SELECT *from tpersona where DNI=".$vars['DNI'];
		$this->Consultar();	
		if (count($this->rows)>0) {
		 		return "Ya Existe DNI";
		 	} 
		 else
		 {
		 	return "";
		 }	
	}//BuscarDocente
	public function BuscarDocente($vars)
	{		
		$this->consulta="SELECT tpersona.Nombre, tpersona.Apellido, tusuario.idtUsuario as idUsuario FROM tusuario
						inner join tpersona on tpersona.DNI=tusuario.DNI where tusuario.DNI=".$vars['DNI'].";";
		$this->Consultar();			
		return $this->rows;	
	}

	public function VerificarCodigo($vars)
	{
		$this->consulta="SELECT *from testudiante where Codigo=".$vars['Codigo'];
		$this->Consultar();	
		if (count($this->rows)>0) {
		 		return "Ya Existe Codigo";
		 	} 
		 else
		 {
		 	return "";
		 }
	}	

	public function BuscarEstudiante($vars)
	{
		$this->consulta="call spBuscaMatricula('".$vars['DNI']."');";
		$this->Consultar();	
		return $this->rows;	
	}

	public function BuscarMatriculaEstudiante($vars)

	{

		$respuesta=$vars;

		return $respuesta;

	}

	public function BuscarsgtCiclo($vars)

	{

		$this->consulta="SELECT idMatricula,codigo,idCarga,idCiclo FROM tmatricula where tmatricula.codigo=".$vars['Codigo'].";";


		$this->Consultar();	

		return $this->rows;	

	}

	public function ListarDocente($vars)
	{
		$this->consulta="SELECT tdocente.idDocente as idDocente,GROUP_CONCAT(tpersona.Nombre,' ',tpersona.Apellido) as Nombre from tdocente inner join tpersona on tdocente.DNI=tpersona.DNI;";
		$this->Consultar();	
//		echo $this->consulta;
		return $this->rows;	
	}

	function __destruct() 

	{  

	    unset($this);

	} 

}?>