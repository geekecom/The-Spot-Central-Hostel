<?php
	if(empty($_REQUEST['DNI_busqueda'])){
		header("Location:BuscarReserva.php");
	}
	$dni_busq = $_REQUEST['DNI_busqueda'];
	$query ="SELECT * FROM RESERVAS JOIN CLIENTES ON RESERVAS.ID_CLIENTE = CLIENTES.ID_CLIENTE JOIN PERSONAS ON
				CLIENTES.DNI = PERSONAS.DNI WHERE PERSONAS.DNI = '$dni_busq'";
	
	require_once("../reservas/GestionarReserva.php");
	require_once("../general/GestionBD.php");
	require_once("../general/Funciones.php");
	
	$conexion = CrearConexionBD();
	error_reporting(E_ALL ^ E_NOTICE);
	
?>

<?php require_once '../layouts/header.php'?>
<section><div id='header'>
					<div id='slider'>
						<a href="../spot/informacion.php#reservas"><img src="../css/images/exclama.png" alt="" /></a></h2>
						<div id='slider-holder'>
  							<div id='mostrar'>
									 <?php $filas = devuelveListaEmpleados($conexion, $query); 
										foreach($filas as $fila) {
											$id_reserva = $fila['ID_RESERVA'];?> 
									
						<div id="mostrarReserva">
							<div id="derecha">
								<a href="GestionarReserva.php?eliminar=<?php echo $id_reserva; ?>"  onclick="return confirm('¿Esta seguro que desea cancelar la reserva?')"><img src="../css/images/borr.png" alt="" /></a>
							</div>
					       <form>
					       	<div id="div_datos_personales">
							
							<legend>Datos personales</legend>
					        <div id="div_dni">
								<label for="dni" id="label_dni">D.N.I.: <?php echo $fila['DNI'];?></label>
							</div>
							<div id="div_nombre">
								<label for="nombre" id="label_nombre">Nombre: <?php echo $fila['NOMBRE'];?>   <?php echo $fila['APELLIDOS'];?></label>
							</div>
							<div id="div_direccion">
								<label for="direccion" id="label_direccion">Dirección: <?php echo $fila['DIRECCION'];?></label>
							</div>	
							<div id="div_emailTel">
								<label for="emailTel" id="label_emailTel">Email: <?php echo $fila['EMAIL'];?>   Teléfono: <?php echo $fila['TELEFONO'];?></label>
							</div>
							</div>
						  	<div id="div_datos_reserva">
								<legend>Datos de la estancia</legend>
								<div id="div_numPers">
									<label for="numPers" id="label_numPers">Numero de personas:<?php echo $fila['NUM_PERSONAS'];?></label>	
								</div>
								<div id="div_fechas">
									<label for="fecEntrada" id="fecEntrada">Fechas de Estancia:  <?php echo $fila['FEC_ENTRADA'];?>  -  <?php echo $fila['FEC_SALIDA'];?></label>
								</div>
								<div id="div_empresa">
									<label for="empresa" id="label_empresa"> Empresa mediadora: <?php echo $fila['EMPRESA_RESERVA'];?></label>
								</div>
							</form>
			        		<?php } ?> 
			        	</div>
							
							<a href="BuscarReserva.php"><input type="submit" value="Volver"></input></a>
					</div>
				</div>
			</div>
   		</div>
 	</div>    
</section>

<?php require_once '../layouts/footer.php';
	CerrarConexionBD($conexion);
?>
	
	
