<?php
	
	require_once("../general/GestionBD.php");
	require_once("../general/Funciones.php");
	
	session_start();
	$form_usuario = $_SESSION["usuario"];
	$conexion = CrearConexionBD();
	
	if(isset($form_usuario)){
		$form_usuario['login'] = $_REQUEST['login'];
		$form_usuario['pass'] = $_REQUEST['pass'];
		$_SESSION['formulario'] = $form_usuario;
	}else{
		header("../administracion/login.php");
	}
	
	$errores = validarUsuario($form_usuario);
	
	if (count($errores) > 0){
	  	$_SESSION["errores"] = $errores;
		header("Location:../administracion/login.php");
	}else{
		$usuario = $form_usuario['login'];
		$pass = $form_usuario['pass'];
		$SQL = "SELECT * FROM USUARIOS WHERE USUARIO='$usuario' AND PASS='$pass'";
		$valusuario = $conexion->query($SQL);
		
		$SQL2 = "SELECT COUNT(*) AS NUM FROM USUARIOS WHERE USUARIO='$usuario' AND PASS='$pass'";
		$numUsuario = $conexion->query($SQL2);
		
		$user = 0;
		foreach ($numUsuario as $n) {
			$user = $n['NUM'];
		}
		
		if($user == 0){ //Compruebo que no existe el usuario
			$errores[] = "El usuario no existe o la contraseña no es correcta";
			$_SESSION["errores"] = $errores;
			header("Location:../administracion/login.php");
		}else{
			foreach ($valusuario as $user){
				if($user[2] == 1){
					header("Location:../administracion/FormAdministrador.php");
					limpia_variables_sesion();
				}else{
					header("Location:../empleados/Empleados.php");
					limpia_variables_sesion();
				}
				session_destroy();
			}
		}
	}
	CerrarConexionBD($conexion);
?>