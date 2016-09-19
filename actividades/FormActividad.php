<?php
	require_once '../layouts/header.php';
	error_reporting(E_ALL ^ E_NOTICE);
	
	session_start();

	if (!isset($_SESSION['formulario'])) {
		$formulario['nombre'] = "";
		$formulario['apellidos'] = "";
		$formulario['email'] = "";
		$formulario['telefono'] = "";
		$formulario['numParticipantes']="";
		$formulario['actividad']="";
		$formulario['dni']="";
		$formulario['observaciones']="";
		$formulario['direccion']="";
		$formulario['sexo']="";
		$formulario['nacionalidad']="";
		$formulario['fechaNacimiento']="";
		
		$_SESSION['formulario'] = $formulario;
	}
	else
		  $formulario = $_SESSION['formulario'];
	
	if (isset($_SESSION['errores']))
			  $errores = $_SESSION['errores'];
	
?>
<?php 
	if (isset($errores) && count($errores)>0) { 
		echo "<div id=\"div_errores\" class=\"error\">";
		foreach($errores as $error) {
			echo $error . "<br/>"; 
		}
    echo "</div>";
	}
?>


<section>
	<div id='header'>
		<div id='slider'>
			<a href="../spot/informacion.php#formEmpleado"><img src="../css/images/exclama.png" alt="" /></a>
			<div id='slider-holder'>
				<div id="forms">
	
				<form action="TratamientoActividad.php">
					<div id="div_actividad">
						<label for="actividad" id="label_actividad">Elija una actividad:</label>
						<input id="actividad" name="actividad" type="text" value="<?php echo $formulario['actividad'];?>" 
						required ="required"/>
					</div>
					<div id="div_num_participantes">
						<label for="num_participantes" id="label_num_participantes">Número de participantes:</label>
						<input id="num_participantes" name="numParticipantes" 
						value="<?php echo $formulario['numParticipantes'];?>" type ="number" />
					</div>
					</br>
					<div id="div_datos_personales">
						<fieldset>
						<legend>Datos personales</legend>
							<div id = "div_sexo">
								<label for="sexo" id="label_sexo">Sexo</label>
								<input id = "Mujer"  type="radio" name="sexo" value="Mujer"
									<?php echo ($formulario['sexo']=="Mujer")?"checked='checked'":'' ?> checked/>Mujer
								<input id = "Hombre"  type="radio" name="sexo" value="Hombre"
									<?php echo ($formulario['sexo']=="Hombre")?"checked='checked'":'' ?>/>Hombre
							</div>
							<div id = "div_nombre">
								<label for="nombre" id="label_nombre">Nombre</label>
								<input id = "nombre"  type="text" name="nombre" 
									value="<?php echo $formulario["nombre"];?>" required="required"/>
							</div>
							<div id = "div_apellidos">
								<label for="apellidos" id="label_apellidos">Apellidos</label>
								<input id = "apellidos" type="text" name="apellidos" 
								value="<?php echo $formulario['apellidos'];?>" required="required"/>
							</div>
							<div id = "div_dni">
								<label for="dni" id="label_apellidos">DNI</label>
								<input id = "dni" type="text" name="dni" value="<?php echo $formulario['dni'];?>"
									size="6" maxlenght="3" required="required" pattern="[0-9]{8}[A-Z]{1}" title="8 dígit"/>
							</div>
							<div id = "div_email">
								<label for="emailAddress">Correo electrónico</label>
								<input type="email" name="email" id="email" 
								placeholder="name@example.com" 
								value="<?php echo $formulario['email'];?>" 
								required="required" autofocus="autofocus" maxlength="50" />
							</div>
							<div id = "div_telefono">
								<label for="telefono">Tlf de contacto:</label>
								<input id = "telefono" type="text" name="telefono" value="<?php echo $formulario['telefono'];?>"
									required="required" pattern="[0-9]{9}" title="9 dígitos" size="9" maxlength="9"/>
							</div>
							<div id = "div_nacionalidad">
								<label for="nacionalidad" id="label_nacionalidad">Nacionalidad</label>
								<input id = "nacionalidad" type="text" name="nacionalidad" 
									value="<?php echo $formulario['nacionalidad'];?>" required="required"/>
							</div>
							<div id = "div_direccion">
								<label for="direccion" id="label_direccion">Dirección</label>
								<input id = "direccion"  type="text" name="direccion" 
									value="<?php echo $formulario["direccion"];?>" required="required"/>
							</div>
							<div id = "div_fechaNacimiento">
								<label for="fechaNacimiento" id="label_fechaNacimiento">fechaNacimiento</label>
								<input id = "fechaNacimiento"  type="date" name="fechaNacimiento" 
									value="<?php echo $formulario["fechaNacimiento"];?>" required="required"/>
							</div>
							</fieldset>
							<fieldset>
							<legend>Observaciones</legend>
							
							<div id = "div_observaciones">
								<label for="observaciones" id="label_observaciones"></label>
								<input id = "observaciones"  type="textarea" name="observaciones" 
									value="<?php echo $formulario["observaciones"];?>"/>
							</div>
							</fieldset>
							</div>
							<div id="div_submit">
								<input type="submit" value="Reservar"></input>
							</div>
				</form>
				<a href="actividad.php"><input type="submit" value="Volver"></input></a>
				</div>
			</div>
   		 </div>
    </div>               
 </section>
<?php require_once '../layouts/footer.php';?>