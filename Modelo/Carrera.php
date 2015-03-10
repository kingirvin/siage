<?php
require_once('Base.php');
class ModeloCarrera extends ModeloBase
{
	function __construct() 
	{
		@session_start();
	}
	public function Listar($vars)
	{
		
		$this->consulta="SELECT idCarrera as idCarrera, Nombre as nombre FROM tcarrera;";
	 	$this->Consultar();	 	
	 	return $this->rows;
	}
	public function ListarCiclo($vars)
	{
		$this->consulta="SELECT tciclo.idCiclo as idCiclo, tsemestre.Nombre FROM tciclo
inner join tsemestre on tciclo.IdSemestre=tsemestre.IdSemestre;";
	 	$this->Consultar();	 	
	 	return $this->rows;
	}
	public function ListarModulo($vars)
	{
		$this->consulta="SELECT idModulo as idModulo,idCarrera,Nombre FROM tmodulo where idCarrera='SI';";
	 	$this->Consultar();	 	
	 	return $this->rows;
	}	
	//SELECT idcategoria, nombre FROM fuente.categoria	
	function __destruct() 
	{  
	    unset($this);
	} 
}?>