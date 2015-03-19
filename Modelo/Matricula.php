<?php



require_once('Base.php');



 



class ModeloMatricula extends ModeloBase



{



	function __construct() 



	{



		@session_start();



	}

	public function Listar($vars)

	{		

		$this->consulta="SELECT tcurso.idCurso as idCurso,tcurso.Nombre as Nombre,tarea_curso.Nombre as Area FROM tcurso

						inner join tarea_curso on tarea_curso.idArea_Curso=tcurso.idArea_Curso;";

	 	$this->Consultar();	

	 	return $this->rows;	

	}	

	public function RegistrarMatricula($vars)

	{

		$this->consulta = "call spAgregaMatricula(".$vars['idCarga'].",".$vars['idCiclo'].",'".$vars['idCarrera']."','".$vars['Codigo']."');";
			echo $this->consulta;
		$this->Consultar();

		return $this->rows;

	}

	public function VerificarMatricula($vars)
	{
		$this->consulta="SELECT tmatricula.idMatricula FROM tmatricula 
						inner join tcarga on tcarga.idCarga=tmatricula.idCarga
						inner join tperiodo on tperiodo.idPeriodo=tcarga.idPeriodo
						inner join testudiante on testudiante.codigo=tmatricula.codigo
						where tperiodo.Estado=1 and (testudiante.codigo='".$vars['DNI']."' or testudiante.DNI='".$vars['DNI']."')";
	 	$this->Consultar();
	 	return $this->rows; 	
	}	

	public function CantidadModular($vars)

	{		

		$this->consulta="SELECT count(*) as cantidad  FROM tcurso_ciclo

						inner join tciclo on tciclo.idCiclo=tcurso_ciclo.idCiclo

						inner join tcurso on tcurso.idCurso=tcurso_ciclo.idCurso

						inner join tmodulo on tmodulo.idtModulo=tciclo.idModulo

						inner join tmodulogeneral on tmodulogeneral.idModuloGeneral=tmodulo.idModuloGeneral

						inner join tarea_curso on tarea_curso.idArea_Curso=tcurso.idArea_Curso 

						where tciclo.idCiclo=".$vars[0]['idCiclo']." and tarea_curso.Nombre='ESPECIALIDAD';";

	 	$this->Consultar();	

	 	//print_r($this->rows);

	 	return $this->rows;

	}	

	public function BuscarUsuario($vars)

	{	

		$this->consulta="SELECT * from tUsuario;";

	 	$this->Consultar();	 	

	 	return $this->rows;

	}		

	function __destruct() 

	{  

	    unset($this);

	} 

}?>