<?php
 
	require_once('../general/GestionBD.php');
	require_once('../general/Funciones.php');
	session_start();
	
	$errores = recupera_errores();
	$id_reserva = "";
	
	if (isset($_SESSION['errores']))
		$errores = $_SESSION['errores'];
	
	$formulario = inicializa_formularioReserva();
?>

<?php require_once '../layouts/header.php';?>
<section>
<div id='header'>
	<div id='slider'>
		<a href="../spot/informacion.php#reservas"><img src="../css/images/exclama.png" alt="" /></a></h2>
			 
		<div id='slider-holder'>
			<div id="forms">
				<?php ver_errores($errores); ?>
					<form action="TratamientoNuevaReserva.php">
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
						
						<div id="div_datos_reserva">
								<fieldset>
								<legend>Datos de la estancia</legend>
								<div id="div_numPers">
									<label for="numPers" id="label_numPers">Numero de personas:</label>
									<select id="numPers" name="numPers" value="<?php echo $formulario['numPers'];?>">
				            			<option>1</option><option>2</option><option>3</option><option>4</option><option>5</option>
				               			<option>6</option><option>7</option><option>8</option><option>9</option><option>10</option>
				           			</select>
								</div>
								<div id="div_fecEntrada">
									<label for="fecEntrada" id="fecEntrada">Fecha de Entrada:</label>
									<select id="diaEnt" name="diaEnt"><?php echo elegirDia($formulario['diaEnt']);?></select>
				            			<label for="mesEnt" id="label_mesEnt">/</label>
									<select id="mesEnt" name="mesEnt"><?php echo elegirMes($formulario['mesEnt']);?></select>
				            			<label for="annoEnt" id="label_annoEnt">/</label>
				            		<select id="annoEnt" name="annoEnt"><?php echo elegirAnno($formulario['annoEnt']);?></select>
								</div>
								<div id="div_fecSalida">
									<label for="fecSalida" id="fecSalida">Fecha de Salida:</label>
									<select id="diaSal" name="diaSal"><?php echo elegirDia($formulario['diaSal']);?></select>	
				       	     		<label for="mesSal" id="label_mesSal">/</label>
									<select id="mesSal" name="mesSal"><?php echo elegirMes($formulario['mesSal']);?></select>				            
				            		<label for="annoSal" id="label_annoSal">/</label>
				           			<select id="annoSal" name="annoSal"><?php echo elegirAnno($formulario['annoSal']);?></select>
								</div>
								</fieldset>
								</div>
								<div id="div_empresa">
								<fieldset>
								<legend>Empresa que reserva</legend>
								<div id="div_empresa">
									<label for="empresa" id="label_empresa"></label>
									<textarea id="empresa" name="empresa" value="<?php echo $formulario['empresa']?trim($formulario['descripcion']):'';?>"></textarea>
								</div>
								</fieldset>
								</div>
								<div id="div_submit">
									<input type="submit" value="Reservar"></input>
								</div>
								</fieldset>
								<input type="hidden" id='cli' name='cli' value="<?php echo $formulario['cli']=$id_reserva; ?>"></input>
						</form>
					</div>
					<a href="Reserva.php"><input type="submit" value="Volver"></input></a>
			    	
				</div>
			</div>
   		 </div>          
 </section>
<?php require_once '../layouts/footer.php';?>
	
		

