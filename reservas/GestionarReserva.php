<?php
	error_reporting(E_ALL ^ E_NOTICE);
	require_once("../general/GestionBD.php");
	
	$id= $_GET['eliminar'];
	if($id>0){
		eliminarReserva($id);
	}

function insertarReserva($dni, $letra, $nombre, $apellidos, $direccion, $nacimiento, $nacionalidad, $sexo, $email,
							$numPers,$fecEnt, $fecSal, $telefono, $empresa, $empleado, $conexion){
	try{
		$fNacimiento = $nacimiento->format('d/m/Y');
		$ffecEnt = $fecEnt->format('d/m/Y');
		$ffecSal = $fecSal->format('d/m/Y');

		$id_emp = 1;
		$proceso = 'Online';
		insertarPersona2($dni, $letra, $nombre, $apellidos, $direccion, 
					$fNacimiento, $nacionalidad, $sexo, $email, $conexion);
		
		$nDNI = $dni . $letra;
		if(empty($telefono)){
			$telefono = 0;
		}
		insertarCliente2($telefono, $empresa, $nDNI, $id_emp, $conexion);
		
		$SQL = "SELECT ID_CLIENTE FROM CLIENTES WHERE DNI='$nDNI'";
		$id_cliente = $conexion->query($SQL);
		
		foreach($id_cliente as $id_cli){
			$SQL = "INSERT INTO RESERVAS (NUM_PERSONAS,FEC_ENTRADA, FEC_SALIDA, EMPRESA_RESERVA, 
					ID_CLIENTE,	ID_EMPLEADO,PROCESO_RESERVA) VALUES ($numPers,'$ffecEnt', '$ffecSal', '$empresa', $id_cli[0], $id_emp, '$proceso')";
			$fila = $conexion->exec($SQL);
		}
		
	}catch(PDOException $e) {
      echo $e->getMessage();
	  $_SESSION['excepcion']="Error de inserción";
	  echo $_SESSION['excepcion'];
      //header("Location:../general/Error.php");
    }
}

function actualizarReserva($dni, $letra, $nombre, $apellidos, $direccion, $nacimiento, $nacionalidad, $sexo, $email,
							$numPers,$fecEnt, $fecSal, $telefono, $empresa, $empleado, $id_reserva, 
							$conexion){
	try{
		$fNac=new DateTime();
		
		$fNacimiento = $fNac->format('d/m/Y');
		$ffecEnt = $fecEnt->format('d/m/Y');
		$ffecSal = $fecSal->format('d/m/Y');

		$id_emp = 1;
		
		actualizarPersona2($dni, $letra, $nombre, $apellidos, $direccion, 
					$fNacimiento, $nacionalidad, $sexo, $email, $conexion);
					
		$nDNI = $dni . $letra;		
		$SQL = "SELECT ID_CLIENTE FROM CLIENTES WHERE DNI='$nDNI'";
		$id_cliente = $conexion->query($SQL);
		
		$id_cli = 0;
		foreach ($id_cliente as $clien) {
			$id_cli = $clien['ID_CLIENTE'];	
		}
		actualizarCliente2($telefono, $empresa, $dni, $id_emp, $id_cli, $conexion);
		
		$SQL = "UPDATE Reservas SET Num_Personas = $numPers, Fec_Entrada = '$ffecEnt',
                Fec_Salida = '$ffecSal', Empresa_Reserva = $empresa, Id_Cliente = $id_cli, Id_Empleado = $id_emp, Proceso_Reserva = $proceso 
                WHERE Id_Reserva = $id_reserva";
		$fila = $conexion->exec($SQL);
		
	}catch(PDOException $e){
		echo $e->getMessage();
	  	$_SESSION['excepcion']="Error de inserción";
	  	echo $_SESSION['excepcion'];
      	header("Location:../general/Error.php");
	}
}

function eliminarReserva($id_reserva){
	$conexion= CrearConexionBD();
	try{
		$SQL = "DELETE FROM RESERVAS WHERE ID_RESERVA = $id_reserva";
		echo $SQL;
		$conexion->exec($SQL);
		header("Location:Reserva.php");
		CerrarConexionBD($conexion);
	}catch(PDOException $e){
		echo $e->getMessage();
	  	$_SESSION['excepcion']="Error de inserción";
	  	echo $_SESSION['excepcion'];
      	header("Location:../general/Error.php");
	}
}
							
function insertarPersona2($dni, $letra, $nombre, $apellidos, $direccion, $fNacimiento, $nacionalidad, 
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
				}
			}
		}
	}catch(PDOException $e){
		echo $e->getMessage();
	  	$_SESSION['excepcion']="Error de inserción";
	  	echo $_SESSION['excepcion'];
      	//header("Location:../general/Error.php");
	}
}

function insertarCliente2($telefono, $obser, $dni, $emp, $conexion){
	try{
		$SQL = "INSERT INTO CLIENTES (TELEFONO, OBSERVACIONES, DNI, ID_EMPLEADO) VALUES
									($telefono, '$empresa', '$dni', $emp)";
									
		$filacli = $conexion->exec($SQL);
	}catch(PDOException $e){
		echo $e->getMessage();
	  	$_SESSION['excepcion']="Error de inserción";
	  	echo $_SESSION['excepcion'];
      	//header("Location:../general/Error.php");
	}
}

function devuelveLista2($conexion, $sentencia){
	try{	
		$lista = $conexion->query($sentencia);
		return $lista;
	}catch(PDOException $e){
		echo $e;
	}
	
}

function actualizarPersona2($dni, $letra, $nombre, $apellidos, $direccion, $fNacimiento, $nacionalidad, 
							$sexo, $email, $conexion){
	try{
		$nDNI = $dni . $letra;
		
		$SQL = "UPDATE PERSONAS SET NOMBRE = '$nombre', APELLIDOS = '$apellidos', DIRECCION = '$direccion',
	                        FEC_NACIMIENTO = '$fNacimiento', SEXO = '$sexo', EMAIL = '$email' 
	                        WHERE DNI = '$nDNI'";
	    
	    $fila = $conexion->exec($SQL);
	}catch(PDOException $e){
		echo $e->getMessage();
	  	$_SESSION['excepcion']="Error de inserción";
	  	echo $_SESSION['excepcion'];
      	header("Location:../general/Error.php");
	}
}

function actualizarCliente2($telefono, $empresa, $dni, $emp, $id_cli, $conexion){
	try{
		$SQL = "UPDATE CLIENTES SET TELEFONO = $telefono, OBSERVACIONES = '$empresa' WHERE ID_CLIENTE = $id_cli";
	    $fila = $conexion->exec($SQL);
	}catch(PDOException $e){
		echo $e->getMessage();
	  	$_SESSION['excepcion']="Error de inserción";
	  	echo $_SESSION['excepcion'];
      	header("Location:../general/Error.php");
	}
}

function paginacionReservas($conexion, $query, $page_num, $page_size){
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
	} catch ( PDOException $e ) {
		 echo $e->getMessage();
	  	$_SESSION['excepcion']="Error de inserción";
	  	echo $_SESSION['excepcion'];
      	header("Location:../general/Error.php");
	}
}

function totalQuery2($conn, $query ) {
	 try {
	 	$total_query = "SELECT COUNT(*) AS TOTAL FROM ($query)"; 
	 	$stmt = $conn->query($total_query); 
	 	$result = $stmt->fetch(); 
	 	$total = $result['TOTAL']; 
	 return (int)$total; 
	 } catch ( PDOException $e ) {
	 	 echo $e->getMessage();
	  	$_SESSION['excepcion']="Error de inserción";
	  	echo $_SESSION['excepcion'];
      	header("Location:../general/Error.php");
	 }
}
?>	
	