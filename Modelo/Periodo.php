<?php

require_once('Base.php');



class ModeloPeriodo extends ModeloBase

{

	function __construct() 

	{

		@session_start();

	}	

	public function ValidarPeriodo($vars)

	{

		$this->consulta="SELECT *from tperiodo where Nombre='".$vars['Periodo']."'";

		$this->Consultar();		

		if (count($this->rows)>0) 

		{

			return "Periodo ya existe";

		} 

		else

		{

			return "Periodo disponible";

		}	

	}	


	public function Registrar($vars)
	{	

		$this->consulta="SELECT *from tperiodo where Nombre='".$vars['Nombre']."'";
		$this->Consultar();		
		if (count($this->rows)>0) 
		{
			return "Periodo ya existe";
		} 
		else
		{
			//actualiza el periodo o semestre activo
			$this->consulta ="SELECT MAX(idPeriodo) as idPeriodo FROM tperiodo";
			$this->Consultar();
			$this->rows;
			$idPeri=$this->rows[0]["idPeriodo"];
			$this->consulta ="UPDATE tperiodo SET Estado=0 where idPeriodo=".$idPeri;			
			$this->Ejecutar();
			//crea nuevo periodo
			$this->consulta = "INSERT INTO tperiodo(Nombre,estado) 
						values('".$vars['Nombre']."',1);";
			$this->Ejecutar();
			//crea las cargas de los periodos
			$this->consulta ="SELECT idCarrera as idCarrera FROM tcarrera";
			$this->Consultar();
			$carrera=$this->rows;
			$this->consulta ="SELECT MAX(idPeriodo) as idPeriodo FROM tperiodo";
			$this->Consultar();
			$this->rows;
			$idPeriodo=$this->rows[0]["idPeriodo"];			
			foreach ($carrera as $dato) {
				$this->consulta ="SELECT idCiclo as idCiclo FROM tciclo where idCarrera='".$dato["idCarrera"]."'";				
				$this->Consultar();
				$ciclo=$this->rows;
				foreach ($ciclo as $dato2) {					
					$this->consulta = "INSERT INTO tcarga(idPeriodo,idCiclo,idCarrera) values(".$idPeriodo.",".$dato2["idCiclo"].",'".$dato["idCarrera"]."');";
					echo $dato2["idCiclo"];
					$this->Ejecutar();

				}			
			}
			

			//return "Periodo Registrado Existosamente";
		}
	}	
	public function UltimoPeriodo($vars)
	{
		$this->consulta="SELECT *from tperiodo where estado=1";
		$this->Consultar();	
		return $this->rows;
	}

	public function BuscarPeriodo($vars)

	{

		$this->consulta="SELECT tcarga.idCarga, tcarga.idPeriodo, tcarga.idCiclo, idCarrera, tperiodo.Nombre

						FROM tcarga

						INNER JOIN tperiodo ON tperiodo.idPeriodo = tcarga.idPeriodo

						WHERE tperiodo.estado =1

						AND tcarga.idCiclo =".$vars["idCiclo"]."

						LIMIT 0 , 30";

		$this->Consultar();	

		return $this->rows;

	}

	public function VerificarCodigo($vars)

	{

		

	}	

	public function BuscarEstudiante($vars)

	{

		

	}

	public function Listar($vars)

	{

		$this->consulta="SELECT * FROM tperiodo;";

		$this->Consultar();	

		return $this->rows;	

	}

	function __destruct() 

	{  

	    unset($this);

	} 

}?>