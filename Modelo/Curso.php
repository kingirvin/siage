<?php
require_once('Base.php');
class ModeloCurso extends ModeloBase
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
	public function ListarDocente($vars)
	{
		$this->consulta="SELECT tcurso.idCurso as idCurso,tcurso.Nombre as Nombre,tarea_curso.Nombre as Area FROM tcurso
						inner join tarea_curso on tarea_curso.idArea_Curso=tcurso.idArea_Curso;";
	 	$this->Consultar();	
	 	return $this->rows;	
	}	
	public function RegistrarCursoCliclo($vars)
	{
		$this->consulta="call spAgregaCursoCiclo(".$vars["idCursos"].",".$vars["idCiclo"].",'".$vars["Carrera"]."',".$vars["idModulo"].");";	
		$this->Consultar();
		return $this->rows;
	}
	public function RegistrarCurso($vars)
	{
		$this->consulta="call spAgregaCurso(".$vars["idArea"].",'".$vars["Nombre"]."','".$vars["Descripcion"]."',".$vars["Horas"].",".$vars["Creditos"].");";
		$this->Ejecutar();
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
	public function ListarArea($vars)
	{
		$this->consulta="SELECT idArea_Curso as idArea,Nombre as Nombre FROM tarea_curso order BY Nombre DESC;";
	 	$this->Consultar();	
	 	return $this->rows;	
	}		
	public function ListaCursosCiclo($vars)
	{
		$this->consulta="SELECT tcurso_semestre.idCurso_Semestre, tciclo.idCiclo, tarea_curso.Nombre AS AreaCurso, tcurso.Nombre AS CursoNombre, tcurso.Horas, tcurso.Creditos as Creditos
		FROM tcurso_semestre
		INNER JOIN tciclo ON tciclo.idCiclo = tcurso_semestre.idCiclo
		INNER JOIN tcurso ON tcurso.idCurso = tcurso_semestre.idCurso
		INNER JOIN tarea_curso ON tarea_curso.idArea_Curso = tcurso.idArea_Curso
		WHERE tciclo.idCiclo =".$vars["DNI"]."
		ORDER BY tarea_curso.Nombre =  'ESPECIALIDAD' DESC LIMIT 0 , 30;";
	 	$this->Consultar();	
	 	//echo $this->consulta;
	 	//print_r();  RegistrarCurso	
	 	return $this->rows;
	}
	function __destruct() 
	{  
	    unset($this);
	} 
}?>