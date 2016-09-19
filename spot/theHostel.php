<?php
	require_once("../general/Funciones.php");
		
	?>

<?php require_once '../layouts/header.php'?>
<section><div id='header'>
			
			<div id="main">
					<div class="cols three-cols">
	                	
	                <h3>Galeria de fotos:<a href="../spot/informacion.php#galeria"><img src="../css/images/exclama.png" alt="" /></a></h3>
	               </div>
						<div id='galeria'>
							<?php	
							$imagenes = glob("../css/images/galeria/*.*");
							//print_r($imagenes);
							foreach ($imagenes as $img) {
							echo "<img src='$img' />";
							}
?>	
						</div>
					
              	   <!--</div>
                </div>-->	
                </div>
               
	                <div class="cols three-cols">
	                	
	                <p>Accommodation Information: <br><br>Thel Spot Central hostel has private double rooms and dorms with 4, 6 and 10 beds.
						<br>We include sheets and towels available for guests.<br>All rooms are equipped with air conditioning and free WIFI internet.
						<br>Breakfast included in price.<br>Toast, Cereals, Milk, Coffee, Juices, Cacao, Biscuits...</p>
	                
	                </div>
                </div>
                 </section>

<?php require_once '../layouts/footer.php'?>