<?php
if(class_exists('Constantes') === false or !class_exists('Constantes'))
{
    include_once('Recursos/Constantes.php');
}

abstract class ModeloBase 
{	
	protected $consulta;
	protected $rows = array();
	private $conn;
	public $mensaje='Hecho';

	private function AbrirConexion()
	{
		$this->conn = new mysqli(Constantes::Host, Constantes::User, Constantes::Password, Constantes::DataBase);
		$this->conn->set_charset("utf8");
	}

	private function CerrarConexion() 
	{
		$this->conn->close();
	}

	protected function Ejecutar() 
	{
		if($_POST) 
		{
			$this->AbrirConexion();				
			if($this->conn->query($this->consulta))
			{
				return true;
			}
			else
			{
				$this->mensaje = $this->conn->error;
				$this->CerrarConexion();
				return false;
			}					
		} 
		else 
		{
			$this->mensaje = 'Metodo no permitido';
			$this->CerrarConexion();
			return false;				
		}			
	}
	protected function Agregar()
	{
		
		$this->AbrirConexion();	
		$result = $this->conn->query($this->consulta); 
		if($result)
		{
		 	while ($aux = $result->fetch_assoc())
			{
				$this->rows[] = $aux;					
			}

			$result->free();
			$this->CerrarConexion();	
			return true;
		}
		else
		{
			$this->mensaje = $this->conn->error;
			$this->CerrarConexion();
			return 0;
		}
	}
	protected function Consultar() 
	{
		$this->rows = array();
		$this->AbrirConexion();
		$result = $this->conn->query($this->consulta);

		if ($result) 
		{
			while ($aux = $result->fetch_assoc())
			{
				$this->rows[] = $aux;					
			}

			$result->free();
			$this->CerrarConexion();	
			return true;
		}
		else
		{
			$this->mensaje = $this->conn->error;
			$this->CerrarConexion();	
			return false;
		}			

	}
}
?>