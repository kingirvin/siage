<?php
require_once('Base.php');
class ModeloCarga extends ModeloBase
{
	function __construct() 
	{
		@session_start();
	}
	public function ListarCursoCarga($vars)
	{
		$this->consulta="call spBuscaCargaCurso(".$vars["idperiodo"].",'".$vars["Carrera"]."');";
	 	$this->Consultar();		 	
	 	return $this->rows;	
	}	
	public function RegistrarCursoCiclo($vars)
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
	public function RegistrarCursoCarga($vars)
	{
		$this->consulta = "INSERT INTO tcurso_carga(idCarga,idDocente,idCurso_Semestre) 
						values(".$vars['idCarga'].",".$vars['Docente'].",".$vars['idCurso_Semestre'].");";
						echo $vars['Docente'];
		$this->Ejecutar();
	}	
	function __destruct() 
	{  
	    unset($this);
	} 
}?>