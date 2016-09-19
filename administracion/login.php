<?php
	require_once("../general/Funciones.php");
		
	session_start();
	$formulario = inicializa_formLogin();
		
	$errores = recupera_errores();
	if (isset($_SESSION['errores']))
		$errores = $_SESSION['errores'];
?>

<?php require_once '../layouts/header.php'?>
<section><div id='header'>
					<div id='slider'>
						<div id='slider-holder'>
						<?php	ver_errores($errores); ?>
					<div id='loginX'>
					<h2>Abrir sesi&oacute;n</h2>
					<form method='post' action='ValidacionUsuario.php'> 
						<div>
							<label>Usuario:</label>
							<input id="login" name="login" type="text" value="<?php echo $formulario['login'];?>"></input>
						</div>
						<div>
							<label>Contrase&ntilde;a:</label>
							<input id='pass' name='pass' type='password' value="<?php echo $formulario['pass'];?>"></input>
						</div>
						<div>
							<input name='enviar' type='submit' value='Aceptar'></input>
						</div>
					</form>
						</div>
              	   </div>
                 </div>
                </div>
                 </section>
<?php require_once '../layouts/footer.php'?>