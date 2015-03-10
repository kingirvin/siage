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
		$this->Consultar();
		return $this->rows;
	}
	public function VerificarMatricula($vars)
	{		
		$this->consulta="SELECT *from tmatricula where codigo=".$vars[0]['codigo']."and idCiclo=".$vars[0]['idPeriodo'].";";
	 	$this->Consultar();
	 	if (count($this->rows)>0)
	 		{
	 			return "Matriculado";
	 		}	
	 	else
	 		{
	 			return "Alumno no Matriculado";
			}	 	
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