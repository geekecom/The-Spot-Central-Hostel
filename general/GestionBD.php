<?php

function CrearConexionBD()
{
	$host="oci:dbname=localhost:1521/XE;charset=UTF8";
	$usuario="proyecto";
	$password="iissi";
	$conexion=null;
	
	try{
		$conexion=new PDO($host,$usuario,$password);
    	
     /* Indicar que queremos que lance excepciones cuando ocurra un error*/ 
     $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    	
	}catch(PDOException $e){
		$_SESSION['excepcion']=$e;
		header("Location:Error.php");
	}
	return $conexion;
}

function CerrarConexionBD($conexion){
	$conexion=null;
}

?>