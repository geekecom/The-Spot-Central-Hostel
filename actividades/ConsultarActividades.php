<?php
	error_reporting(E_ALL ^ E_NOTICE);
	session_start();
	
	if (!isset($_SESSION['formul'])) {
		echo "dniNoSet";
		$formul["dni"] = "";
		
		$_SESSION['formul']= $formul;
	}
	else{
		echo"dniSet";	
	}
 require_once('../layouts/header.php');?>
<section>
	<div id='header'>
		<div id='slider'>
			<div id='slider-holder'>
				<div id='loginX'>
					<h2>Introduzca el DNI de la reserva de actividad</h2>
					<div id="Busqueda">
		        		<form id="busqueda" action="TratamientoReservaActividad.php">
							<label for="DNI_busq">DNI:</label>
							<input id = "dni" type="text" name="dni" value="<?php echo $formul["dni"];?>"
								size="6" maxlenght="3" required="required" pattern="[0-9]{8}[A-Za-z]{1}" 
								title="8 dígitos y letra"/>
								
							<input type="submit" value="Consultar"></input>
						</form>
              		</div>
            	</div>
        	</div>
    	</div>
	</div>
</section>


<?php require_once '../layouts/footer.php';?>