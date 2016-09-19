<?php
	error_reporting(E_ALL ^ E_NOTICE);
	require_once("GestionBD.php");
	
	$id = $_GET['eliminar'];
	if($id>0){
		eliminarOcupacion($id);
	}
	
	$id_empl = $_GET['eliminarE'];
	if($id_empl>0){
		eliminarEmpleado($id_empl);
	}

function insertarOcupacion($dni, $letra, $nombre, $apellidos, $direccion, $nacimiento, $nacionalidad, $sexo, $email,
							$numHab, $numCama, $fecEnt, $fecSal, $telefono, $obser, $empleado, $conexion){
	try{
		$fNacimiento = $nacimiento->format('d/m/Y');
		$ffecEnt = $fecEnt->format('d/m/Y');
		$ffecSal = $fecSal->format('d/m/Y');
		
		$letra = strtoupper($letra);
		
		$nDNI = $dni . $letra;
		
		//Comprobamos si existe la persona
		$SQL = "SELECT COUNT(*) FROM PERSONAS WHERE DNI='$nDNI'";
		$existe = $conexion->query($SQL);
		foreach($existe as $e){
			if($e[0] == 0){
				insertarPersona($dni, $letra, $nombre, $apellidos, $direccion, 
						$fNacimiento, $nacionalidad, $sexo, $email, $conexion);
			}else{
				actualizarPersona($dni, $letra, $nombre, $apellidos, $direccion, 
						$fNacimiento, $nacionalidad, $sexo, $email, $conexion);
			}
		}
		
		//Comprobamos si existe el cliente
		$SQL = "SELECT COUNT(*) FROM CLIENTES WHERE DNI='$nDNI'";
		$existe = $conexion->query($SQL);
		
		if(empty($telefono)){
			$telefono = 0;
		}
		
		foreach ($existe as $e) {
			if($e[0] == 0){
				insertarCliente($telefono, $obser, $nDNI, $empleado, $conexion);
			}else{
				$SQL2 = "SELECT * FROM CLIENTES WHERE DNI='$nDNI'";
				$cli = $conexion->query($SQL2);
				foreach ($cli as $c){
					$id_cli = $c['ID_CLIENTE'];
				}
				actualizarCliente($telefono, $obser, $dni, $empleado, $id_cli, $conexion);
			}
		}
		
		
		$SQL = "SELECT ID_CLIENTE FROM CLIENTES WHERE DNI='$nDNI'";
		$id_cliente = $conexion->query($SQL);
		
		foreach($id_cliente as $id_cli){
			$SQL = "INSERT INTO OCUPACION (NUM_HABITACION, NUM_CAMA, FEC_ENTRADA, FEC_SALIDA, 
					ID_CLIENTE,	ID_EMPLEADO) VALUES ($numHab, $numCama, '$ffecEnt', '$ffecSal', $id_cli[0], $empleado)";
		$fila = $conexion->exec($SQL);
		}
		//Funciona correctamente
		/*$SQL = "INSERT INTO OCUPACION (NUM_HABITACION, NUM_CAMA, FEC_ENTRADA, FEC_SALIDA, 
					ID_CLIENTE,	ID_EMPLEADO) VALUES ($numHab, $numCama, '$ffecEnt',
					'25/05/2014', 3, 1)";*/
		//echo "/" . $SQL . "/";
		//$fila = $conexion->exec($SQL);
		//echo "/" . $SQL . "/";
	}catch(PDOException $e) {
      echo $e->getMessage();
	  $_SESSION['excepcion']="Error de inserción de ocupacion";
	  echo $_SESSION['excepcion'];
      //header("Location:../general/Error.php");
    }
}

function actualizarOcupacion($dni, $letra, $nombre, $apellidos, $direccion, $nacimiento, $nacionalidad, $sexo, $email,
							$numHab, $numCama, $fecEnt, $fecSal, $telefono, $obser, $empleado, $id_ocupacion, 
							$conexion){
	try{		
		$fNacimiento = $nacimiento->format('d/m/Y');
		$ffecEnt = $fecEnt->format('d/m/Y');
		$ffecSal = $fecSal->format('d/m/Y');
		
		$letra = strtoupper($letra);
		
		actualizarPersona($dni, $letra, $nombre, $apellidos, $direccion, 
					$fNacimiento, $nacionalidad, $sexo, $email, $conexion);
					
		$nDNI = $dni . $letra;		
		$SQL = "SELECT ID_CLIENTE FROM CLIENTES WHERE DNI='$nDNI'";
		$id_cliente = $conexion->query($SQL);
		
		foreach ($id_cliente as $clien) {
			$id_cli = $clien['ID_CLIENTE'];	
		}
		actualizarCliente($telefono, $obser, $dni, $empleado, $id_cli, $conexion);
		
		$SQL = "UPDATE Ocupacion SET Num_Habitacion = $numHab, Num_Cama = $numCama, Fec_Entrada = '$ffecEnt',
                Fec_Salida = '$ffecSal', Id_Cliente = $id_cli, Id_Empleado = $empleado 
                WHERE Id_Ocupacion = $id_ocupacion";
				
		$fila = $conexion->exec($SQL);
		
	}catch(PDOException $e){
		echo $e->getMessage();
	  	$_SESSION['excepcion']="Error de actualización de ocupacion";
	  	echo $_SESSION['excepcion'];
      	header("Location:../general/Error.php");
	}
}

function eliminarOcupacion($id_ocupacion){
	$conexion= CrearConexionBD();
	try{
		$SQL = "DELETE FROM OCUPACION WHERE ID_OCUPACION = $id_ocupacion";
		$conexion->exec($SQL);
		CerrarConexionBD($conexion);
		header("Location:../ocupacion/Ocupacion.php");		
	}catch(PDOException $e){
		echo $e->getMessage();
	  	$_SESSION['excepcion']="Error de borrado de ocupacion";
	  	echo $_SESSION['excepcion'];
      	header("Location:../general/Error.php");
	}
}

function insertarEmpleado($dni, $letra, $nombre, $apellidos, $direccion, $nacimiento, $nacionalidad, $sexo, $email,
							 $cargo,$telefono, $fecAlta, $fecBaja, $conexion){
	try{		
		$letra = strtoupper($letra);
		
		$nDNI = $dni . $letra;
		
		$fNacimiento = $nacimiento->format('d/m/Y');
		$ffecAlta = $fecAlta->format('d/m/Y');
		if(empty($fecBaja)){
			$ffecBaja = null;
		}else{
			$ffecBaja = $fecBaja->format('d/m/Y');
		}
		
		$SQL = "SELECT COUNT(*) FROM PERSONAS WHERE DNI='$nDNI'";
		$existe = $conexion->query($SQL);
		foreach($existe as $e){
			if($e[0] == 0){
				insertarPersona($dni, $letra, $nombre, $apellidos, $direccion, 
						$fNacimiento, $nacionalidad, $sexo, $email, $conexion);
			}else{
				actualizarPersona($dni, $letra, $nombre, $apellidos, $direccion, 
						$fNacimiento, $nacionalidad, $sexo, $email, $conexion);
			}		
		}
		if(empty($telefono)){
			$telefono = 0;
		}
		
		$SQL = "INSERT INTO EMPLEADOS (TELEFONO, FEC_ALTA, FEC_BAJA, CARGO, DNI) VALUES 
				($telefono, '$ffecAlta', '$ffecBaja', '$cargo', '$nDNI')";
		
		$fila = $conexion->exec($SQL);
	}catch(PDOException $e){
		echo $e->getMessage();
	  	$_SESSION['excepcion']="Error de inserción de empleado";
	  	echo $_SESSION['excepcion'];
      	header("Location:../general/Error.php");
	}		
}

function actualizarEmpleado($dni, $letra, $nombre, $apellidos, $direccion, $nacimiento, $nacionalidad, $sexo, $email,
							$cargo,  $telefono, $fecAlta, $fecBaja, $id_empleado, $conexion){
	try{		
		$fNacimiento = $nacimiento->format('d/m/Y');
		$ffecAlta = $fecAlta->format('d/m/Y');
		if(empty($fecBaja)){
			$ffecBaja = null;
		}else{
			$ffecBaja = $fecBaja->format('d/m/Y');
		}
		
		$letra = strtoupper($letra);
		
		actualizarPersona($dni, $letra, $nombre, $apellidos, $direccion, 
					$fNacimiento, $nacionalidad, $sexo, $email, $conexion);
		
		$SQL = "UPDATE Empleados SET telefono = $telefono, cargo = '$cargo', Fec_alta = '$ffecAlta',
                Fec_baja = '$ffecBaja' WHERE Id_Empleado = $id_empleado";
		
		$fila = $conexion->exec($SQL);
		
	}catch(PDOException $e){
		echo $e->getMessage();
	  	$_SESSION['excepcion']="Error de actualización del empleado";
	  	echo $_SESSION['excepcion'];
      	header("Location:../general/Error.php");
	}
}

function eliminarEmpleado($id_empleado){
	$conexion= CrearConexionBD();
	try{
		$SQL = "DELETE FROM EMPLEADOS WHERE ID_EMPLEADO = $id_empleado";
		$conexion->exec($SQL);
		CerrarConexionBD($conexion);
		header("Location:../empleados/Empleados.php");		
	}catch(PDOException $e){
		echo $e->getMessage();
	  	$_SESSION['excepcion']="Error de borrado del empleado";
	  	echo $_SESSION['excepcion'];
      	header("Location:../general/Error.php");
	}
}
						
function insertarPersona($dni, $letra, $nombre, $apellidos, $direccion, $fNacimiento, $nacionalidad, 
							$sexo, $email, $conexion){
		
	try{		
		$nDNI = $dni . $letra;
		$SQL = "SELECT COUNT(*) FROM CLIENTES WHERE DNI='$nDNI'";
		$dniExiste = $conexion->query($SQL);
			
		if(!$dniExiste){
			echo "<p>Error en la consulta</p>";
		}else{
			foreach($dniExiste as $valor){
				if($valor[0] == 0){
					$stmt=$conexion->prepare("INSERT INTO PERSONAS (DNI, NOMBRE, APELLIDOS, DIRECCION, FEC_NACIMIENTO, NACIONALIDAD,
													SEXO, EMAIL) VALUES (:dni,:nombre,:apellidos,:direccion,:fec_nacimiento,
													:nacionalidad,:sexo,:email)");
					
				  	$stmt->bindParam(':dni',$nDNI);
				  	$stmt->bindParam(':nombre',$nombre);
				  	$stmt->bindParam(':apellidos',$apellidos);
				  	$stmt->bindParam(':direccion',$direccion);
					$stmt->bindParam(':fec_nacimiento',$fNacimiento);
					$stmt->bindParam(':nacionalidad',$nacionalidad);
					$stmt->bindParam(':sexo',$sexo);
					$stmt->bindParam(':email',$email);
				  	$stmt->execute();
				  	/*$SQL2 = "INSERT INTO PERSONAS (DNI, NOMBRE, APELLIDOS, DIRECCION, FEC_NACIMIENTO, NACIONALIDAD,
													SEXO, EMAIL) VALUES ('$nDNI','$nombre','$apellidos',
													'$direccion','$fNacimiento',
													'$nacionalidad','$sexo','$email')";
					echo "<br>Persona---- " . $SQL2;
					//$fila = $conexion->exec($SQL2);*/
				}
			}
		}
	}catch(PDOException $e){
		echo $e->getMessage();
	  	$_SESSION['excepcion']="Error de inserción de persona";
	  	echo $_SESSION['excepcion'];
      	//header("Location:../general/Error.php");
	}
}

function insertarCliente($telefono, $obser, $dni, $emp, $conexion){
	try{
		$SQL = "INSERT INTO CLIENTES (TELEFONO, OBSERVACIONES, DNI, ID_EMPLEADO) VALUES
									($telefono, '$obser', '$dni', $emp)";
		$filacli = $conexion->exec($SQL);
	}catch(PDOException $e){
		echo $e->getMessage();
	  	$_SESSION['excepcion']="Error de inserción de cliente";
	  	echo $_SESSION['excepcion'];
      	//header("Location:../general/Error.php");
	}
}

function devuelveListaEmpleados($conexion, $sentencia){
	try{	
		$lista = $conexion->query($sentencia);
		return $lista;
	}catch(PDOException $e){
		echo $e;
	}
	
}

function actualizarPersona($dni, $letra, $nombre, $apellidos, $direccion, $fNacimiento, $nacionalidad, 
							$sexo, $email, $conexion){
	try{
		$nDNI = $dni . $letra;
		
		$SQL = "UPDATE PERSONAS SET NOMBRE = '$nombre', APELLIDOS = '$apellidos', DIRECCION = '$direccion', NACIONALIDAD = '$nacionalidad',
	                        FEC_NACIMIENTO = '$fNacimiento', SEXO = '$sexo', EMAIL = '$email' 
	                        WHERE DNI = '$nDNI'";
		
	    $fila = $conexion->exec($SQL);
	}catch(PDOException $e){
		echo $e->getMessage();
	  	$_SESSION['excepcion']="Error de actualización de persona";
	  	echo $_SESSION['excepcion'];
      	header("Location:../general/Error.php");
	}
}

function actualizarCliente($telefono, $obser, $dni, $emp, $id_cli, $conexion){
	try{
		$SQL = "UPDATE CLIENTES SET TELEFONO = $telefono, OBSERVACIONES = '$obser' WHERE ID_CLIENTE = $id_cli";
		
	    $fila = $conexion->exec($SQL);
	}catch(PDOException $e){
		echo $e->getMessage();
	  	$_SESSION['excepcion']="Error de actualización de cliente";
	  	echo $_SESSION['excepcion'];
      	header("Location:../general/Error.php");
	}
}

function paginacionOcupacion($conexion, $query, $page_num, $page_size){
	try {
		$first = ($page_num - 1) * $page_size + 1;
		$last = $page_num * $page_size;
		
		$paged_query = "SELECT * FROM (SELECT ROWNUM RNUM, AUX.*FROM ($query) AUX WHERE ROWNUM <= :last)
							WHERE RNUM >= :first";
							
		$stmt = $conexion->prepare($paged_query); 
		$stmt->bindParam( ':first', $first ); 
		$stmt->bindParam( ':last', $last ); 
		$stmt->execute(); 
		return $stmt; 
	} catch(PDOException $e) {
		echo $e->getMessage();
	  	$_SESSION['excepcion']="Error en la muestra de la lista de ocupacion";
	  	echo $_SESSION['excepcion'];
      	header("Location:../general/Error.php");
	}
}

function totalQuery($conn, $query) {
	 try {
	 	$total_query = "SELECT COUNT(*) AS TOTAL FROM ($query)"; 
	 	$stmt = $conn->query($total_query); 
	 	$result = $stmt->fetch(); 
	 	$total = $result['TOTAL']; 
	 return (int)$total; 
	 } catch ( PDOException $e ) {
	 	 echo $e->getMessage();
	  	$_SESSION['excepcion']="Error de sentencia";
	  	echo $_SESSION['excepcion'];
      	header("Location:../general/Error.php");
	 }
}
?>