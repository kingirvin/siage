<?php
require_once('Base.php');
class ModeloAccion extends ModeloBase
{
	function __construct() 
	{
		@session_start();
	}
	public function Listar($vars)
	{
		$this->consulta="SELECT * from elemento;";
	 	$this->Consultar();	 	
	 	return $this->rows;
	}	
	//SELECT idcategoria, nombre FROM fuente.categoria	
	public function BuscarAccion($vars)
	{	
		$this->consulta="SELECT t.idAccion, m.Accion, m.Nombre FROM ttipo_usuario_accion t
		JOIN taccion m ON t.idAccion=m.idAccion	where t.idTipo_usuario=".$vars['idTipo_usuario'].";";
	 	$this->Consultar();		 	
	 	return $this->rows;
	}		
	function __destruct() 
	{  
	    unset($this);
	} 
}?>