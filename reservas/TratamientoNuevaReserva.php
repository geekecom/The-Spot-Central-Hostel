<?php
	require_once("../reservas/GestionarReserva.php");
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
		$formulario["email"] = $_REQUEST["email"];
		$formulario["dia"] = $_REQUEST["dia"];
		$formulario["mes"] = $_REQUEST["mes"];
		$formulario["anno"] = $_REQUEST["anno"];
		$formulario["numPers"] = $_REQUEST["numPers"];
		$formulario["direccion"] = $_REQUEST["direccion"];
		$formulario["diaEnt"] = $_REQUEST["diaEnt"];
		$formulario["mesEnt"] = $_REQUEST["mesEnt"];
		$formulario["annoEnt"] = $_REQUEST["annoEnt"];
		$formulario["diaSal"] = $_REQUEST["diaSal"];
		$formulario["mesSal"] = $_REQUEST["mesSal"];
		$formulario["annoSal"] = $_REQUEST["annoSal"];
		$formulario["telefono"] = $_REQUEST["telefono"];
		$formulario["empresa"] = $_REQUEST["empresa"];
		$_SESSION["formulario"] = $formulario;
	}else
		Header("Location:FormCrearReserva.php");
  
	$errores = validar($formulario);
	
	if (count($errores) > 0){
	  	$_SESSION["errores"] = $errores;
		Header("Location:FormCrearReserva.php");
	}
?>
<?php require_once '../layouts/header.php'?>

		<div><?php $fec_nac = unirFecha($formulario['dia'], $formulario['mes'], $formulario['anno']);
			$fec_ent = unirFecha($formulario['diaEnt'], $formulario['mesEnt'], $formulario['annoEnt']);
			$fec_sal = unirFecha($formulario['diaSal'], $formulario['mesSal'], $formulario['annoSal']);
			
			if(!empty($formulario['cli'])){ //Se va a actualizar, si no se inserta
				$id_reserva = $formulario['cli'];
				actualizarReserva($formulario['dni'], $formulario['letra'], $formulario['nombre'], $formulario['apellidos'],
							$formulario['direccion'], $fec_nac, $formulario['nacionalidad'], 
							$formulario['sexo'], $formulario['email'], $formulario['numPers'], 
							$fec_ent, $fec_sal, $formulario['telefono'], 
							$formulario['empresa'], $formulario['empleado'], $id_reserva, $conexion);
			}else{			
				insertarReserva($formulario['dni'], $formulario['letra'], $formulario['nombre'], $formulario['apellidos'],
							$formulario['direccion'], $fec_nac, $formulario['nacionalidad'], 
							$formulario['sexo'], $formulario['email'], $formulario['numPers'], 
							$fec_ent, $fec_sal, $formulario['telefono'], 
							$formulario['empresa'], $formulario['empleado'], $conexion);
			}
			if(count($errores) == 0){
				limpia_variables_sesion();
			}
			?>
			
<section>
	<div id='header'>
					<div id='slider'>
						<div id='slider-holder'>
							<div id='loginX'>
								<h2>Reserva realizada correctamente</h2>
								<div id="div_volver">
										Pulse <a href="Reserva.php">aquí</a> para volver a la página inicial
								</div>
							</div>
              	  	 	</div>
                 	</div>
     </div>
</section>

<?php require_once '../layouts/footer.php';
	CerrarConexionBD($conexion)?>
		