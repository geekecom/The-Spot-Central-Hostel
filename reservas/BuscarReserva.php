<?php require_once '../layouts/header.php';
	session_start();
	unset ($_SESSION['errores']);?>
<section>
	<div id='header'>
					<div id='slider'>
						<div id='slider-holder'>
							<div id='loginX'>
								<h2>Introduzca el DNI de la reserva</h2>
								<div id="Busqueda">
        <form id="busqueda" action="Reserva.php">
        	<div id="div_dni">
				<label for="DNI_busq">DNI:</label>
				<input id="DNI_busqueda" name="DNI_busqueda" type="text" maxlength="9" size="12"/>
				<a href="Reserva.php"><button type="submit">Buscar</button>
							</div>
              	  	 	</div>
                 	</div>
                </div>
                </div>
                </div>
                 </section>


<?php require_once '../layouts/footer.php';?>
	