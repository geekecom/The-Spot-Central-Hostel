<?php
function insertarReservaActividad(
	$sexo,
	$nombre,
	$apellidos,
	$dni,
	$letra,
	$fechaNacimiento,
	$nacionalidad,
	$direccion,
	$email,
	$personas,
	$empresa,
	$conexion){
try{
	
		
		$fechaNacimiento = NULL;
		$email = NULL;
		$id_emp = 1;
		
		

					$SQL = ("INSERT INTO PERSONAS (DNI, NOMBRE, APELLIDOS, DIRECCION, 
						FEC_NACIMIENTO, NACIONALIDAD,SEXO, EMAIL) VALUES
						('$dni','$nombre','$apellidos','$direccion',
						'$fechaNacimiento','$nacionalidad','$sexo','$email')");
						
						echo $SQL;
					
						$filacli = $conexion->exec($SQL);
						
					
	}catch(PDOException $e) {
      echo $e->getMessage();
	  $_SESSION['excepcion']="Error de inserción";
	  echo $_SESSION['excepcion'];
  
    }
   
}
	
?>
