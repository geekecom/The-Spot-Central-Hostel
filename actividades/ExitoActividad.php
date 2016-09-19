<?php
	session_start();
	$datos_formulario = $_SESSION["formulario"];
	//$_SESSION["formulario"]=null;
	//$_SESSION["errores"]=null;
    //unset($_SESSION["formulario"]);
	//unset($_SESSION["errores"]);

	require_once("../general/GestionBD.php");
	require_once("../actividades/GestionActividad.php");
	require_once("../layouts/header.php");

	$conexion = CrearConexionBD();
?>
<section>
    <div>
		<?php
			insertarReservaActividad(
				$datos_formulario["sexo"],
				$datos_formulario["nombre"],
				$datos_formulario["apellidos"],
				$datos_formulario["dni"],
				$datos_formulario["letra"],
				$datos_formulario["fechaNacimiento"],
				$datos_formulario["nacionalidad"],
				$datos_formulario["direccion"],
				$datos_formulario["email"],
				$datos_formulario["numParticipantes"],
				//empresa
				null,
				$conexion
				);
							/*insertarPersona(
				$datos_formulario["dni"],
				$datos_formulario["nombre"],
				$datos_formulario["apellidos"],
				$datos_formulario["direccion"],
				//Fecha
				null,
				$datos_formulario["nacionalidad"],
				$datos_formulario["sexo"],
				$datos_formulario["email"],
				$conexion
				);
			
			insertarCliente(
				);
				
			insertarReserva(
				$datos_formulario["IdCliente"],
				//IdEmpleado
				null,
				$datos_formulario["IdActividad"],
				$conexion);*/
		?>
		<h1>Su entrada se registró correctamente</h1>
		<div id="div_volver">
			Pulse <a href="index.php">aquí</a> para volver a la página inicial
		</div>
    </div>
</section>

<?php
	require_once("../layouts/footer.php");
	CerrarConexionBD($conexion);
?>