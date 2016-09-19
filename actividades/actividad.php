<?php
$query ="SELECT ID_ACTIVIDAD, NOMBRE FROM ACTIVIDADES";
	require_once("../general/Funciones.php");
	require_once '../layouts/header.php'?>
	
<section>
	<div id='header'>
		<div id="main">
			<div id='galeria'>
			<div class="cols three-cols">    
				<div class="cl">&nbsp;</div>
					<div class="col">	
						<img src="../css/images/actividades/bici.jpg"/>
						<h1>Alquila una bici: <a href="FormActividad.php?id=1" method="get">Reserva</a></h1>
						<p>Alquileres desde 1/2 hora hasta 1 dia entero  </p>
						
					</div>
					<div class="col">
						<img src="../css/images/actividades/images.jpg"/>
						<h1>Tour por el centro de la ciudad: <a href="FormActividad.php?id=2">Reserva</a></h1>
						<p>Visita guiada por el centro. Jardines del Alcazar, catedral... Finalmente tour por bares centricos con tapa incluida</p>
					</div>
					<div class="col col-last">	
						<img src="../css/images/actividades/torreoro1.jpg"/>
						<h1>Sube a la Torre del Oro: <a href="FormActividad.php?id=3">Reserva</a></h1>
						<p>Pack que incluye subida a la torre del Oro y viaje en barco por el rio Guadalquivir</p>
					</div>
				</div>
				<div class="cols three-cols">    
				<div class="cl">&nbsp;</div>
					<div class="col">	
						<img src="../css/images/actividades/playa-de-la-victoria.jpg"/>
						<h1>Exursion a la playa: <a href="FormActividad.php?id=4">Reserva</a></h1>
						<p>Cada semana una playa distinta, Cadiz, huelva y Malaga. Ida y Vuelta en Micro-bus, Salida a las 9 de la mñn y vuelta a las 8 de la tarde</p>
					</div>
					<div class="cl">&nbsp;</div>
				</div>
					
			</div>
		</div>
 </section>

<?php require_once '../layouts/footer.php'?>