<?php
	require_once('GestionBD.php');
	require_once('GestionarBD.php');

function inicializa_formularioOcupacion(){
	$formulario = isset($_SESSION['formulario'])?$_SESSION['formulario']:null;
	if (!isset($_SESSION['formulario'])) {
		$formulario['dni'] = $formulario['letra'] = $formulario['nombre'] = $formulario['apellidos'] = 
		$formulario['nacionalidad'] = $formulario['anno'] = $formulario['email'] = $formulario['annoEnt'] = 
		$formulario['annoSal'] = "";
		$formulario['sexo'] = "hombre";
		$formulario['telefono'] = $formulario['direccion'] = $formulario['empleado'] = "";
		$formulario['observaciones'] = "";
		$_SESSION['formulario'] = $formulario;
	}
	else
		$formulario = $_SESSION['formulario'];
	
	if (isset($_SESSION['errores']))
		$errores = $_SESSION['errores'];	
	
	return $formulario;
}

function inicializa_form_Actualizar($id_ocupacion, $formulario){
	$conexion = CrearConexionBD();
	
	$sentencia = "SELECT * FROM OCUPACION JOIN CLIENTES ON OCUPACION.ID_CLIENTE = CLIENTES.ID_CLIENTE JOIN PERSONAS ON
					CLIENTES.DNI = PERSONAS.DNI WHERE OCUPACION.ID_OCUPACION = $id_ocupacion";
	
	$ocupacion = devuelveListaEmpleados($conexion, $sentencia);
	
	foreach ($ocupacion as $ocu) {		
		$dia_nac = substr($ocu['FEC_NACIMIENTO'], 0, 2);
		$mes_nac = substr($ocu['FEC_NACIMIENTO'], 3, 2);
		$anno_nac = substr($ocu['FEC_NACIMIENTO'], 6, 4);
		
		$dia_ent = substr($ocu['FEC_ENTRADA'], 0, 2);
		$mes_ent = substr($ocu['FEC_ENTRADA'], 3, 2);
		$anno_ent = substr($ocu['FEC_ENTRADA'], 6, 4);
		
		$dia_sal = substr($ocu['FEC_SALIDA'], 0, 2);
		$mes_sal = substr($ocu['FEC_SALIDA'], 3, 2);
		$anno_sal = substr($ocu['FEC_SALIDA'], 6, 4);		
 		
		$dni_recortado = substr($ocu['DNI'], 0, 8);
		$letra_recortada = substr($ocu['DNI'], -1);
		
		$formulario['dni'] = $dni_recortado;
		$formulario['letra'] = $letra_recortada;
		$formulario['nombre'] = $ocu['NOMBRE'];
		$formulario['apellidos'] = $ocu['APELLIDOS'];
		$formulario['nacionalidad'] = $ocu['NACIONALIDAD'];
		$formulario['dia'] = $dia_nac;
		$formulario['mes'] = asignarMes($mes_nac);
		$formulario['anno'] = $anno_nac + 1900;
		$formulario['email'] = $ocu['EMAIL'];
		$formulario['diaEnt'] = $dia_ent;
		$formulario['mesEnt'] = asignarMes($mes_ent);
		$formulario['annoEnt'] = $anno_ent + 2000;
		$formulario['diaSal'] = $dia_sal;
		$formulario['mesSal'] = asignarMes($mes_sal);
		$formulario['annoSal'] = $anno_sal + 2000;
		$formulario['sexo'] = $ocu['SEXO'];
		$formulario['telefono'] = $ocu['TELEFONO'];
		$formulario['direccion'] = $ocu['DIRECCION'];
		$formulario['observaciones'] = $ocu['OBSERVACIONES'];
		$formulario['numPer'] = 1; //modificar
		$formulario['numHab'] = $ocu['NUM_HABITACION'];
		$formulario['numCama'] = $ocu['NUM_CAMA'];
		$formulario['empleado'] = asignarEmpleado($ocu['ID_EMPLEADO']);
	}
	
	CerrarConexionBD($conexion);
	return $formulario;	
}

function inicializa_formLogin(){
	$formulario = isset($_SESSION['usuario'])?$_SESSION['usuario']:null;
	if(!isset($_SESSION['usuario'])){
		$formulario['login'] = $formulario['pass'] = "";
		$_SESSION['usuario'] = $formulario;
	}else{
		$formulario = $_SESSION['usuario'];
	}
	
	if (isset($_SESSION['errores']))
		$errores = $_SESSION['errores'];
	
	return $formulario;
}

function inicializa_formEmpleado(){
	$formulario = isset($_SESSION['formulario'])?$_SESSION['formulario']:null;
	if (!isset($_SESSION['formulario'])) {
		$formulario['dni'] = $formulario['letra'] = $formulario['nombre'] = $formulario['apellidos'] = 
		$formulario['nacionalidad'] = $formulario['anno'] = $formulario['email'] = $formulario['annoAlta'] = 
		$formulario['annoBaja'] = "";
		$formulario['sexo'] = "hombre";
		$formulario['telefono'] = $formulario['direccion'] = $formulario['empleado'] = "";
		$formulario['observaciones'] = "";
		$formulario['cargo'] = "";
		$_SESSION['formulario'] = $formulario;
	}
	else
		$formulario = $_SESSION['formulario'];
	
	if (isset($_SESSION['errores']))
		$errores = $_SESSION['errores'];	
	
	return $formulario;
}

function inicializa_formE_Actualizar($id_empleado, $formulario){
	$conexion = CrearConexionBD();
	
	$sentencia = "SELECT * FROM EMPLEADOS JOIN PERSONAS ON
					EMPLEADOS.DNI = PERSONAS.DNI WHERE EMPLEADOS.ID_EMPLEADO = $id_empleado";
	
	$empleado = devuelveListaEmpleados($conexion, $sentencia);
	
	foreach ($empleado as $emp) {		
		$dia_nac = substr($emp['FEC_NACIMIENTO'], 0, 2);
		$mes_nac = substr($emp['FEC_NACIMIENTO'], 3, 2);
		$anno_nac = substr($emp['FEC_NACIMIENTO'], 6, 4);
		
		$dia_alta = substr($emp['FEC_ALTA'], 0, 2);
		$mes_alta = substr($alta['FEC_ALTA'], 3, 2);
		$anno_alta = substr($ocu['FEC_ALTA'], 6, 4);
		
		$dia_baja = substr($emp['FEC_BAJA'], 0, 2);
		$mes_baja = substr($emp['FEC_BAJA'], 3, 2);
		$anno_baja = substr($emp['FEC_BAJA'], 6, 4);		
 		
		$dni_recortado = substr($emp['DNI'], 0, 8);
		$letra_recortada = substr($emp['DNI'], -1);
		
		$formulario['dni'] = $dni_recortado;
		$formulario['letra'] = $letra_recortada;
		$formulario['nombre'] = $emp['NOMBRE'];
		$formulario['apellidos'] = $emp['APELLIDOS'];
		$formulario['nacionalidad'] = $emp['NACIONALIDAD'];
		$formulario['dia'] = $dia_nac;
		$formulario['mes'] = asignarMes($mes_nac);
		$formulario['anno'] = $anno_nac + 1900;
		$formulario['email'] = $emp['EMAIL'];
		$formulario['diaAlta'] = $dia_alta;
		$formulario['mesAlta'] = asignarMes($mes_alta);
		$formulario['annoAlta'] = $anno_alta + 2000;
		$formulario['diaBaja'] = $dia_baja;
		$formulario['mesBaja'] = asignarMes($mes_baja);
		$formulario['annoBaja'] = $anno_baja + 2000;
		$formulario['sexo'] = $emp['SEXO'];
		$formulario['telefono'] = $emp['TELEFONO'];
		$formulario['direccion'] = $emp['DIRECCION'];
		$formulario['cargo'] = $emp['CARGO'];
		if($emp['FEC_BAJA'] == null){
			$formulario['check_en_plantilla'] = 'true';
		}else{
			$formulario['check_en_plantilla'] = 'false';
		}
	}
	
	CerrarConexionBD($conexion);
	return $formulario;	
}

function inicializa_formularioReserva(){
	$formulario = isset($_SESSION['formulario'])?$_SESSION['formulario']:null;
	if (!isset($_SESSION['formulario'])) {
		$formulario['dni'] = $formulario['letra'] = $formulario['nombre'] = $formulario['apellidos'] = 
		$formulario['nacionalidad'] = $formulario['anno'] = $formulario['email'] = $formulario['annoEnt'] = 
		$formulario['annoSal'] = "";
		$formulario['sexo'] = "hombre";
		$formulario['telefono'] = $formulario["direccion"] = $formulario["empleado"] = "";
		$formulario['empresa'] = "";
		$_SESSION['formulario'] = $formulario;
	}
	else
		$formulario = $_SESSION['formulario'];
	
	if (isset($_SESSION['errores']))
		$errores = $_SESSION['errores'];	
	
	return $formulario;
}

function inicializa_form_ActReserva($id_reserva, $formulario, $conexion){
	$sentencia = "SELECT * FROM RESERVAS JOIN CLIENTES ON RESERVAS.ID_CLIENTE = CLIENTES.ID_CLIENTE JOIN PERSONAS ON
					CLIENTES.DNI = PERSONAS.DNI WHERE RESERVAS.ID_RESERVA = $id_reserva";
	$reserva = devuelveLista($conexion, $sentencia);
	
	foreach ($reserva as $reserv) {
		$dni_recortado = substr($reserv['DNI'], 0, 8);
		$letra_recortada = substr($reserv['DNI'], -1);
		$formulario['dni'] = $dni_recortado;
		$formulario['letra'] = $letra_recortada;
		$formulario['nombre'] = $reserv['NOMBRE'];
		$formulario['apellidos'] = $reserv['APELLIDOS'];
		$formulario['nacionalidad'] = $reserv['NACIONALIDAD'];
		$formulario['email'] = $reserv['EMAIL'];
		$formulario['sexo'] = $reserv['SEXO'];
		$formulario['telefono'] = $reserv['TELEFONO'];
		$formulario["direccion"] = $reserv['DIRECCION'];
		$formulario['empresa'] = $reserv['EMPRESA_RESERVA'];
		$formulario['numPers'] = $reserv['NUM_PERSONAS'];
		
	}
	return $formulario;
}

function limpia_variables_sesion(){
	unset ($_SESSION['errores']);	// Se limpian variables de sesión una vez recuperadas.
	unset ($_SESSION['formulario']);// Al servidor llegará siempre una entrada nueva del cliente (Efecto Refresh!)
}

function elegirAnnoNac($selAño){
	$anno = date("Y");
	
	for ($i = 1940; $i <= ($anno-18); $i++) {
  		if($selAño == $i){
  			$selected = "selected='selected'";
  		}else{
  			$selected = "";
  		}
		echo "<option $selected>$i</option>";
	}
}

function elegirMes($selMes){
	$meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
					'Octubre', 'Noviembre', 'Diciembre');
	$i = 1;
	
	foreach($meses as $mes){
		$value = 'value="' . $i . '"';
		
		if($selMes == $mes){
			$selected = "selected='selected'";
			$value = 'value="' . $i . '"';
		}else{
			$selected = "";
		}
		$i++;
		echo "<option $value $selected>$mes</option>";
	}
}

function asignarMes($mes){
	$meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
					'Octubre', 'Noviembre', 'Diciembre');
					
	$eligeMes = $meses[$mes-1];
	
	return $eligeMes;
}

function elegirDia($selDia){
	for ($i = 1; $i <= 31; $i++) {
  		if($selDia == $i){
  			$selected = "selected='selected'";
  		}else{
  			$selected = "";
  		}
		echo "<option $selected>$i</option>";
	}
}

function elegirAnno($selAño){
	$anno = date("Y");
	
	for ($i = $anno; $i <= ($anno+2); $i++) {
  		if($selAño == $i){
  			$selected = "selected='selected'";
  		}else{
  			$selected = "";
  		}
		echo "<option $selected>$i</option>";
	}
}

function ver_errores($errores){
	if (isset($errores) && count($errores)>0) { 
		echo "<div id='error' class='class_error'>";
		foreach($errores as $error) {
		  echo $error . "<br/>"; 
		}
		echo "</div>";
	}
}

function recupera_errores() {
	return isset($_SESSION['errores'])?$_SESSION['errores']:null;
}

function unirFecha($dia, $mes, $anno){		
	$fecha = new DateTime();
/*switch($mes){
	case 'Enero': $nMes = 1; break;
	case 'Febrero': $nMes = 2; break;
	case 'Marzo': $nMes = 3; break;
	case 'Abril': $nMes = 4; break;
	case 'Mayo': $nMes = 5; break;
	case 'Junio': $nMes = 6; break;
	case 'Julio': $nMes = 7; break;
	case 'Agosto': $nMes = 8; break;
	case 'Septiembre': $nMes = 9; break;
	case 'Octubre': $nMes = 10; break;
	case 'Noviembre': $nMes = 11; break;
	case 'Diciembre': $nMes = 12; break;	
	default: $nMes = 1;	break;
}*/
	//$fecha->setDate($anno,$nMes,$dia);
	$fecha->setDate($anno,$mes,$dia);
	return $fecha;
}

function validar($formulario){
	$errores = array();
	//Email correcto
	if (!empty($formulario['email'])) {
		$patron = '/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])'.'(([a-z0-9-])*([a-z0-9]))+' . '(\.([a-z0-9])([-a-z0-9_-])?([a-z0-9])+)+$/i';
		if (!preg_match($patron, $formulario['email']))
   			$errores[] = "La dirección de <b>e-mail</b> no es válida";
	}else{
		$errores[] = "El campo email no puede estar vacio";
	}
	
	//DNI y letra validos
	if (!empty($formulario['dni']) && !empty($formulario['letra']) ) {
		$tabla =array('T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E');
		$modulo = $formulario['dni'] % 23;
		if (strtoupper($formulario['letra']) != $tabla[$modulo])
			$errores[] = "El <b>DNI</b> y la letra no coinciden.";
	}else{
		$errores[] ="El campo dni no puede estar vacio";
	}
	
	return $errores;
}

function validarUsuario($formulario){
	$error = array();
	if(empty($formulario['login'])){
		$error[] = "El campo usuario no puede estar vacio";
	}
	if(empty($formulario['pass'])){
		$error[] = "El campo contrase&ntilde;a no puede estar vacia";
	}
	return $error;
}

function elegirCargo($selCargo){
	$cargos = array('Director', 'Jefe Existencias', 'Jefe Actividades', 'Encargado Recepción', 'Jefe Compras', 
					'Jefe Facturación', 'Encargado Reservas');
			
	foreach($cargos as $cargo){
		if($selCargo == $cargo){
			$selected = "selected='selected'";
		}else{
			$selected = "";
		}
		echo "<option $selected>$cargo</option>";
	}
}

function sentenciaFiltro($check_dni, $DNI_busqueda, $check_fec_entrada, $fec_ent, $check_fec_salida, $fec_sal, $query){

	$sentencia = $query;
	
	if($check_dni && !$check_fec_entrada && !$check_fec_salida){
		if(!empty($DNI_busqueda)){
			$dni = strtoupper($DNI_busqueda);
			$sentencia = "SELECT * FROM OCUPACION JOIN CLIENTES ON OCUPACION.ID_CLIENTE = CLIENTES.ID_CLIENTE JOIN PERSONAS ON
							CLIENTES.DNI = PERSONAS.DNI WHERE PERSONAS.DNI = '$dni'";
		}
	}elseif(!$check_dni && $check_fec_entrada && !$check_fec_salida){
		$sentencia = "SELECT * FROM OCUPACION JOIN CLIENTES ON OCUPACION.ID_CLIENTE = CLIENTES.ID_CLIENTE JOIN PERSONAS ON
							CLIENTES.DNI = PERSONAS.DNI WHERE OCUPACION.FEC_ENTRADA = '$fec_ent'";
	}elseif(!$check_dni && !$check_fec_entrada && $check_fec_salida){
		$sentencia = "SELECT * FROM OCUPACION JOIN CLIENTES ON OCUPACION.ID_CLIENTE = CLIENTES.ID_CLIENTE JOIN PERSONAS ON
							CLIENTES.DNI = PERSONAS.DNI WHERE OCUPACION.FEC_SALIDA = '$fec_sal'";
	}elseif($check_dni && $check_fec_entrada && !$check_fec_salida){
		$sentencia = "SELECT * FROM OCUPACION JOIN CLIENTES ON OCUPACION.ID_CLIENTE = CLIENTES.ID_CLIENTE JOIN PERSONAS ON
							CLIENTES.DNI = PERSONAS.DNI WHERE OCUPACION.FEC_ENTRADA = '$fec_ent' AND PERSONAS.DNI = '$DNI_busqueda'";
	}elseif($check_dni && !$check_fec_entrada && $check_fec_salida){
		$sentencia = "SELECT * FROM OCUPACION JOIN CLIENTES ON OCUPACION.ID_CLIENTE = CLIENTES.ID_CLIENTE JOIN PERSONAS ON
							CLIENTES.DNI = PERSONAS.DNI WHERE OCUPACION.FEC_SALIDA = '$fec_sal' AND PERSONAS.DNI = '$DNI_busqueda'";
	}elseif(!$check_dni && $check_fec_entrada && !check_fec_salida){
		$sentencia = "SELECT * FROM OCUPACION JOIN CLIENTES ON OCUPACION.ID_CLIENTE = CLIENTES.ID_CLIENTE JOIN PERSONAS ON
							CLIENTES.DNI = PERSONAS.DNI WHERE OCUPACION.FEC_ENTRADA = '$fec_ent' AND OCUPACION.FEC_SALIDA = '$fec_sal'";
	}elseif($check_dni && $check_fec_entrada && $check_fec_salida){
		$sentencia = "SELECT * FROM OCUPACION JOIN CLIENTES ON OCUPACION.ID_CLIENTE = CLIENTES.ID_CLIENTE JOIN PERSONAS ON
							CLIENTES.DNI = PERSONAS.DNI WHERE OCUPACION.FEC_ENTRADA = '$fec_ent' AND OCUPACION.FEC_SALIDA = '$fec_sal'
							AND PERSONAS.DNI = '$DNI_busqueda'";
	}
	
	return $sentencia;
}

function elegirEmpleado($selEmp){
	$conexion = CrearConexionBD();
	
	$sentencia = "SELECT * FROM EMPLEADOS JOIN PERSONAS ON EMPLEADOS.DNI = PERSONAS.DNI";
	
	$empleados = devuelveListaEmpleados($conexion, $sentencia);
	
	foreach ($empleados as $emp) {
		$listaEmpleado = $emp['NOMBRE'] . " " . $emp['APELLIDOS'];
		$value = 'value="' . $emp['ID_EMPLEADO'] . '"';
		
		if($selEmp == $listaEmpleado){
			$selected = "selected='selected'";
			$value = 'value="' . $emp['ID_EMPLEADO'] . '"';
		}else{
			$selected = "";
		}
		
		echo "<option $value $selected>$listaEmpleado</option>";
	}
}

function asignarEmpleado($id_emp){
	$conexion = CrearConexionBD();
	
	$sentencia = "SELECT * FROM EMPLEADOS JOIN PERSONAS ON EMPLEADOS.DNI = PERSONAS.DNI WHERE ID_EMPLEADO=" . $id_emp;
	
	$emp = devuelveListaEmpleados($conexion, $sentencia);
	
	$empleado = "";
	foreach ($emp as $e){
		$empleado = $e['NOMBRE'] . " " . $e['APELLIDOS'];
	}
		
	CerrarConexionBD($conexion);

	return $empleado;
}
?>