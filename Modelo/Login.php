<?php
require_once('Base.php');
class ModeloLogin extends ModeloBase
{
	function __construct() 
	{
		@session_start();
	}	
	public function ValidarLogin($user='', $pass='')
	{
		$this->consulta="SELECT * FROM tusuario WHERE Nombre='$user' AND password='$pass' AND estado=1";
	 	if ($this->Consultar()) 
		{
			if(count($this->rows)>0)
			{
				$_SESSION['xafrhyjo']=array('usuario'=>$this->rows[0]['Nombre'],
									   'password'=>$this->rows[0]['Password'],
									   'idTipo_usuario'=>$this->rows[0]['idTipo_usuario'],
									   'DNI'=>$this->rows[0]['DNI']);
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}	
	public function EstadoLogin()
	{
		if(!isset($_SESSION['xafrhyjo'])) return false;
        if(!is_array($_SESSION['xafrhyjo'])) return false;
        if(empty($_SESSION['xafrhyjo']['usuario'])) return false;
        //print_r($_SESSION['xafrhyjo']);
        return true;
	}
	public function GetNombre()
	{
	 	return $_SESSION['xafrhyjo']['usuario'];
	}	
	public function GetCodigo()
	{
	 	return $_SESSION['xafrhyjo']['password'];
	}
	public function GetTipoUsuario()
	{
	 	return $_SESSION['xafrhyjo']['idTipo_usuario'];
	}
	public function GetTipoDNI()
	{
	 	return $_SESSION['xafrhyjo']['DNI'];
	}
	public function Salir()
	{
		unset($_SESSION['xafrhyjo']);
        session_write_close();
	}
	function __destruct() { 
        unset($this); 
    } 
}
?>