<?php 
	session_start();
	$excepcion=$_SESSION['excepcion'];
	if(isset($excepcion)) 
		unset($_SESSION['excepcion']);
	else
		//header("Location:../index.php");
?>
<?php require_once '../layouts/header.php';?>
<section>	
	
	<h2>Ups!</h2>
	<p>Ocurrió un problema durante el procesado de los datos. Pulse <a href="../index.php">aquí</a> para volver a la página principal.</p>
	
	<?php 
	// Aquí deberíamos almacenar la información del error en un archivo de logs
	
	echo $excepcion;
	?>
	
</section>
<?php require_once '../layouts/footer.php'?>