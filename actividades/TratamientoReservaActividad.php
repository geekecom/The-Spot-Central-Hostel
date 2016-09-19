<?php require_once '../layouts/header.php'?>
<section><div id='header'>
					<div id='slider'>
						<a href="informacion.php#ocupacion"><img src="../css/images/exclama.png" alt="" /></a></h2>
						<div id='slider-holder'>
						<div id="mostrar">
						
<?php
	session_start();
	
	$formul['dni']=$_REQUEST["dni"];
	
	if (!isset($_SESSION['conexion'])){
		require_once("../general/GestionBD.php");
		$conexion = CrearconexionBD();
	}else{
		$conexion = $_REQUEST['conexion'];
	}

	$SQL = "SELECT ID_CLIENTE FROM CLIENTES WHERE DNI = '".$formul['dni']."'";
		$consulta = $conexion -> query($SQL);
		foreach ($consulta as $id) {
			$id_cliente = $id[0];
		}
	$SQL = "SELECT ID_ACTIVIDAD FROM RESERVA_ACTIVIDAD WHERE ID_CLIENTE = '".$id_cliente."'";
	
		$consulta = $conexion -> query($SQL);
		?><div class="tablaOcupacion" >
				<table >
	                	<th>Actividades:</th>
	                	<tr class="Actividades"> <?php $i=1;
		foreach ($consulta as $reserva) {
			$SQL = "SELECT NOMBRE FROM ACTIVIDADES WHERE ID_ACTIVIDAD = '".$reserva[0]."'";
			
			$consulta2 = $conexion -> query($SQL);
			
			
							foreach ($consulta2 as $key) {?>
							<td><?php echo "Reserva ".$i." de: ".$key[0]."</br>";?></td>
							</tr>
							<?php $i++;}}?>
				</table>
	     	</div>
	     <a href="ConsultarActividades.php"><input type="submit" value="Volver"></input></a>       	
						</div>
						</div>
					</div>
				</div>
	</section>
<?php require_once '../layouts/footer.php'?>
	CerrarConexionBD($conexion);?>