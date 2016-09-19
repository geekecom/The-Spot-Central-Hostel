<?php
	require_once("../general/GestionarBD.php");
	require_once("../general/GestionBD.php");
	require_once("../general/Funciones.php");
	
	session_start();
	$formulario = $_SESSION["formulario"];
	$conexion = CrearConexionBD();

	if (isset($formulario)) {
		$formulario["dni"] = $_REQUEST["dni"];
		$formulario["letra"] = $_REQUEST["letra"];
		$formulario["nombre"] = $_REQUEST["nombre"];
		$formulario["apellidos"] = $_REQUEST["apellidos"];
		$formulario["sexo"] = $_REQUEST["sexo"];
		$formulario["nacionalidad"] = $_REQUEST["nacionalidad"];
		$formulario["direccion"] = $_REQUEST["direccion"];
		$formulario["email"] = $_REQUEST["email"];
		$formulario["dia"] = $_REQUEST["dia"];
		$formulario["mes"] = $_REQUEST["mes"];
		$formulario["anno"] = $_REQUEST["anno"];
		$formulario["cargo"] = $_REQUEST["cargo"];
		$formulario["diaAlta"] = $_REQUEST["diaAlta"];
		$formulario["mesAlta"] = $_REQUEST["mesAlta"];
		$formulario["annoAlta"] = $_REQUEST["annoAlta"];
		$formulario["diaBaja"] = $_REQUEST["diaBaja"];
		$formulario["mesBaja"] = $_REQUEST["mesBaja"];
		$formulario["annoBaja"] = $_REQUEST["annoBaja"];
		$formulario["telefono"] = $_REQUEST["telefono"];
		$formulario["empleado"] = $_REQUEST["empleado"];
		$formulario["check_en_plantilla"] = $_REQUEST["check_en_plantilla"];
		$_SESSION["formulario"] = $formulario;
	}else{
		Header("Location:../empleados/FormEmpleado.php");
  	}
  	
	$errores = validar($formulario);
	
	if (count($errores) > 0){
	  	$_SESSION["errores"] = $errores;
		Header("Location:../empleados/FormEmpleado.php");
	}
?>
<?php require_once '../layouts/header.php'?>

		<div><?php 		
			$fec_nac = unirFecha($formulario['dia'], $formulario['mes'], $formulario['anno']);
			$fec_alta = unirFecha($formulario['diaAlta'], $formulario['mesAlta'], $formulario['annoAlta']);
			$fec_baja = unirFecha($formulario['diaBaja'], $formulario['mesBaja'], $formulario['annoBaja']);
			
			if($formulario['check_en_plantilla']){
				$fec_baja = "";
			}
			
			if(!empty($formulario['empleado'])){ //Se va a actualizar, si no se inserta
				$id_empleado = $formulario['empleado'];
			
				actualizarEmpleado($formulario['dni'], $formulario['letra'], $formulario['nombre'], $formulario['apellidos'],
							$formulario['direccion'], $fec_nac, $formulario['nacionalidad'], 
							$formulario['sexo'], $formulario['email'], $formulario['cargo'], 
							$formulario['telefono'],$fec_alta, $fec_baja, $id_empleado, $conexion);
			}else{			
				insertarEmpleado($formulario['dni'], $formulario['letra'], $formulario['nombre'], $formulario['apellidos'],
							$formulario['direccion'], $fec_nac, $formulario['nacionalidad'], 
							$formulario['sexo'], $formulario['email'], $formulario['cargo'], 
							$formulario['telefono'],$fec_alta, $fec_baja, $conexion);
			}
						
			if(count($errores) == 0){
				session_destroy();
			}?>
			
<section>
	<div id='header'>
					<div id='slider'>
						<div id='slider-holder'>
							<div id='loginX'>
								<h2>Nuevo empleado insertado con exito!</h2>
								<div id="div_volver">
										Pulse <a href="../empleados/Empleados.php">aquí</a> para volver a la página inicial
								</div>
							</div>
              	  	 	</div>
                 	</div>
                </div>
                 </section>

<?php require_once '../layouts/footer.php';
	//session_destroy();
	CerrarConexionBD($conexion);
?>
		