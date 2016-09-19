
<?php
	require_once("../general/GestionBD.php");
	session_start();
	
	
	$formul['dni']=$_REQUEST["dni"];
	
	$dni =$formul['dni'];
	/*if (!isset($_SESSION['conexion'])){
		require_once("GestionBD.php");*/
		$conexion = CrearconexionBD();
	/*}else{
		$conexion = $_REQUEST['conexion'];
	}*/
	
?>

<?php require_once '../layouts/header.php'?>
<section><div id='header'>
					<div id='slider'>
						<a href="informacion.php#ocupacion"><img src="css/images/exclama.png" alt="" /></a></h2>
						<div id='slider-holder'>
						<div id="mostrar">
						<div id="cuadro">
							<? $SQL = "SELECT ID_CLIENTE FROM CLIENTES WHERE DNI = '$dni'";
							echo "IDDDD--Cliente ---" . $SQL;
								$consulta = $conexion -> query($SQL);
								foreach ($consulta as $id) {
									$id_cliente = $id[0];
								}
							$SQL = "SELECT ID_ACTIVIDAD FROM RESERVA_ACTIVIDAD WHERE ID_CLIENTE = $id_cliente";
							
								echo "IDDDD--Cliente ---" . $SQL;
								$consulta = $conexion -> query($SQL);
								foreach ($consulta as $reserva) {
									$SQL = "SELECT NOMBRE FROM ACTIVIDADES WHERE ID_ACTIVIDAD = $reserva[0]";
									$consulta2 = $conexion -> query($SQL);
									$i=1;
									foreach ($consulta2 as $key) {
									echo "Reserva ".$i." de: ".$key[0]."</br>";
									$i++;}}				
							?>
				        </div>	
						</div>
						</div>
					</div>
				</div>
	</section>
<?php require_once '../layouts/footer.php';
	CerrarConexionBD($conexion);?>