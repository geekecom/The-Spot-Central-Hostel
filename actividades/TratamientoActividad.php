<?php
	session_start();
	$formulario = $_SESSION["formulario"];

	if (isset($formulario)) {
		$formulario['nombre'] = $_REQUEST["nombre"];
		$formulario['apellidos'] = $_REQUEST["apellidos"];
		$formulario['email'] = $_REQUEST["email"];
		$formulario['telefono'] = $_REQUEST["telefono"];
		$formulario['numParticipantes']= $_REQUEST["numParticipantes"];
		$formulario['actividad']=$_REQUEST["actividad"];
		$formulario['dni']=$_REQUEST["dni"];
		$formulario['letra']=$_REQUEST["letra"];
		$formulario['observaciones']=$_REQUEST["observaciones"];
		$formulario['direccion']=$_REQUEST["direccion"];
		$formulario['sexo']=$_REQUEST["sexo"];
		$formulario['fechaNacimiento']=$_REQUEST["fechaNacimiento"];
		$formulario['nacionalidad']=$_REQUEST["nacionalidad"];
		$_SESSION['formulario'] = $formulario;	
	}
	else
		Header("Location:FormActividad.php");
  
	$errores = validar($formulario);
 
	if (count($errores) > 0) //echo count($errores);
	 {
	   $_SESSION["errores"] = $errores;
	   foreach ($errores as $error) {
		   echo $error;
	   }
		Header("Location:FormActividad.php");
	}
	else
		Header("Location:ExitoActividad.php");

		
function validar($formulario) {
  
  if (!(isset($formulario['nombre']) && strlen($formulario['nombre'])>0))  // Modo resumido: if (empty($formulario['nombre']))
    $errores[] = 'El campo <b>Nombre</b> no puede ser vacío';
    
  if (!(isset($formulario['apellidos']) && strlen($formulario['apellidos'])>0))
    $errores[] = 'El campo <b>Apellidos</b> no puede ser vacío';
    
  if (!(isset($formulario['email']) && strlen($formulario['email'])>0))
    $errores[] = 'El campo <b>email</b> no puede ser vacío';
  
  if (!(isset($formulario['telefono']) && strlen($formulario['telefono'])>0))
    $errores[] = 'El campo <b>telefono</b> no puede ser vacío';
  
  if (!(isset($formulario['email']) && strlen($formulario['telefono'])>0))
    $errores[] = 'El campo <b>telefono</b> no puede ser vacío';
  
    if (!(isset($formulario['numParticipantes']) && strlen($formulario['numParticipantes'])>0))
    $errores[] = 'El campo <b>numParticipantes</b> no puede ser vacío';
    
      if (!(isset($formulario['actividad']) && strlen($formulario['actividad'])>0))
    $errores[] = 'El campo <b>actividad</b> no puede ser vacío';
	  
	   if (!(isset($formulario['dni']) && strlen($formulario['dni'])>0))
    $errores[] = 'El campo <b>telefono</b> no puede ser vacío';
	   
	     if (!(isset($formulario['direccion']) && strlen($formulario['direccion'])>0))
    $errores[] = 'El campo <b>direccion</b> no puede ser vacío';
		 
		   if (!(isset($formulario['fechaNacimiento']) && strlen($formulario['fechaNacimiento'])>0))
    $errores[] = 'El campo <b>fecha de nacimiento</b> no puede ser vacío';
		   		   
		   /*if (!(isset($formulario['nacionalidad']))){// && strlen($formulario['nacionalidad'])>0))
    $errores[] = 'El campo <b>nacionalidad</b> no puede ser vacío';}*/

		if (!(isset($formulario['sexo']) && strlen($formulario['sexo'])>0))
    $errores[] = 'El campo <b>sexo</b> no puede ser vacío';

  return $errores;    
  
}
?>