<?php require_once('../layouts/header.php');

	require_once('../general/GestionBD.php');
	require_once('../general/Funciones.php');
	
	session_start();
	$id_empleado = "";
	
	$errores = recupera_errores();
	if (isset($_SESSION['errores']))
		$errores = $_SESSION['errores'];
	
	$formulario = inicializa_formEmpleado();
	
	if($_GET['modificarE'] != ""){
		$id_empleado = $_GET['modificarE'];
		$formulario = inicializa_formE_Actualizar($id_empleado, $formulario);
	}	
?>

<section>
<div id='header'>
	<div id='slider'>
		<a href="../spot/informacion.php#formEmpleado"><img src="../css/images/exclama.png" alt="" /></a>
		<div id='slider-holder'>
			<div id="forms">
				<?php 
					if ($id_empleado == ""){ 
						ver_errores($errores);
					}
				?>
					<form action="TratamientoNuevoEmpleado.php">
						<div id="div_datos_personales">
							<fieldset>
							<legend>Datos personales</legend>
							<div id="div_sexo">
				              	<div id="div_titulo_sexo">
				                	Sexo:
				              	</div>
				              	<div id="div_sexo_hombre">
				                	<input id="sexo_hombre" name="sexo" type="radio" value="Hombre" 
									<?php echo ($formulario['sexo']=="Hombre")?"checked='checked'":'' ?> />
				                	<label id="label_hombre" for="sexo_hombre">Hombre</label>
				              	</div>
				              	<div id="div_sexo_mujer">
				                	<input id="sexo_mujer" name="sexo" type="radio" value="Mujer"
									<?php echo ($formulario['sexo']=="Mujer")?"checked='checked'":'' ?> />
				                	<label id="label_mujer" for="sexo_mujer">Mujer</label>
				              	</div>
				             </div>
				        	 <div id="div_dni">
									<label for="dni" id="label_dni">D.N.I.:</label>
									<input id="dni" name="dni" type="text" maxlength="8" size="8" value="<?php echo $formulario['dni'];?>"></input>-
				            		<input id="letra" name="letra" type="text" maxlength="1" size="1" value="<?php echo $formulario['letra'];?>"></input>
							</div>
							<div id="div_nombre">
								<label for="nombre" id="label_nombre">Nombre:</label>
								<input id="nombre" name="nombre" type="text" value="<?php echo $formulario['nombre'];?>" size="30"></input>
							</div>
							<div id="div_apellidos">
								<label for="apellidos" id="label_apellidos">Apellidos:</label>
								<input id="apellidos" name="apellidos" type="text" value="<?php echo $formulario['apellidos'];?>" size="30"></input>
							</div>
							<div id="div_direccion">
								<label for="direccion" id="label_direccion">Dirección:</label>
								<input id="direccion" name="direccion" type="text" value="<?php echo $formulario['direccion'];?>" size="50"></input>
							</div>
							<div id="div_nacionalidad">									
								<label for="nacionalidad" id="label_nacionalidad">Nacionalidad:</label>
								<input id="nacionalidad" name="nacionalidad" type="text" value="<?php echo $formulario['nacionalidad'];?>" size="30"></input>
							</div>		
							<div id="div_fecNac">
								<label for="fecNac" id="label_fecNac">Fecha nacimiento:</label>
								<label for="dia" id="label_dia">D&iacute;a:</label>
								<select id="dia" name="dia"><?php echo elegirDia($formulario['dia']);?></select>
			            		<label for="mes" id="label_mes">Mes:</label>
								<select id="mes" name="mes"><?php echo elegirMes($formulario['mes']);?></select>
				            	<label for="anno" id="label_anno">Año:</label>
				           		<select id="anno" name="anno"><?php echo elegirAnnoNac($formulario['anno']);?></select>
							</div>
							<div id="div_email">
								<label for="email" id="label_email">Email:</label>
								<input id="email" name="email" type="text" value="<?php echo $formulario['email'];?>" size="30"></input>
							</div>
							<div id="div_telefono">
								<label for="telefono" id="label_telefono">Teléfono:</label>
								<input id="telefono" name="telefono" type="text" value="<?php echo $formulario['telefono'];?>" size="12"></input>
							</div>
						</fieldset>
					
						<div id="div_datos_empleados">
								<fieldset>
								<legend>Datos del empleado</legend>
								<div id="div_cargo">
									<label for="cargo" id="cargo">Cargo del empleado:</label>
									<select id="cargo" name="cargo" value="<?php echo elegirCargo($formulario['cargo']);?>">
										<?php echo elegirCargo($formulario['cargo']);?>
									</select>
								</div>
								<div id="div_fecAlta">
									<label for="fecAlta" id="fecAlta">Fecha de alta:</label>
									<select id="diaAlta" name="diaAlta"><?php echo elegirDia($formulario['diaAlta']);?></select>
				            			<label for="mesAlta" id="label_mesAlta">/</label>
									<select id="mesAlta" name="mesAlta"><?php echo elegirMes($formulario['mesAlta']);?></select>
				            			<label for="annoAlta" id="label_annoAlta">/</label>
				            		<select id="annoAlta" name="annoAlta"><?php echo elegirAnno($formulario['annoAlta']);?></select>
								</div>
								<div id="div_fecBaja">
									<label for="fecBaja" id="fecBaja">Fecha de baja:</label>
									<select id="diaBaja" name="diaBaja"><?php echo elegirDia($formulario['diaBaja']);?></select>	
				       	     			<label for="mesBaja" id="label_mesBaja">/</label>
									<select id="mesBaja" name="mesBaja"><?php echo elegirMes($formulario['mesBaja']);?></select>				            
				            			<label for="annoBaja" id="label_annoBaja">/</label>
				           			<select id="annoBaja" name="annoBaja"><?php echo elegirAnno($formulario['annoBaja']);?></select>
				           			<input id="check_en_plantilla" name="check_en_plantilla" type="checkbox"> En plantilla</input>
								</div>
								</fieldset>
								</div>
								<div id="div_submit">
									<input type="submit" value="Crear"></input>
									
								</div>
								</fieldset>
								<input type="hidden" id='empleado' name='empleado' value="<?php echo $formulario['empleado']=$id_empleado; ?>"></input>
					
						</form>
				</div>
				<a href="Empleados.php"><input type="submit" value="Volver"></input></a>
			</div>
   		 </div>
    </div>               
 </section>

<?php require_once '../layouts/footer.php'?>
