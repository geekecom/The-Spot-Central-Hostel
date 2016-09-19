<?php
	$query ="SELECT * FROM OCUPACION JOIN CLIENTES ON OCUPACION.ID_CLIENTE = CLIENTES.ID_CLIENTE JOIN PERSONAS ON
				CLIENTES.DNI = PERSONAS.DNI";
	
	require_once("../general/GestionBD.php");
	require_once("../general/GestionarBD.php");
	require_once("../general/Funciones.php");
	
	$conexion = CrearConexionBD();
	error_reporting(E_ALL ^ E_NOTICE);
	
?>

<?php require_once '../layouts/header.php'?>
<section><div id='header'>
					<div id='slider'>
						<a href="../spot/informacion.php#ocupacion"><img src="../css/images/exclama.png" alt="" /></a></h2>
						<div id='slider-holder'>
					
	<div>
		<div id="mostrar">
			
			<div id="cuadro1">
	<div id="Busqueda">
        <form id="busqueda" action="../ocupacion/Ocupacion.php">
        	<div id="div_dni">
	        	<input id="check_dni" name="check_dni" type="checkbox" 
	        	
	        	value="<?php(isset($_REQUEST['check_dni'])?$_REQUEST['check_dni']='true':'')?>"/>
	        	
				<label for="DNI_busq">DNI:</label>
				<input id="DNI_busqueda" name="DNI_busqueda" type="text" maxlength="9" size="9"/>
				
				<input id="check_fec_entrada" name="check_fec_entrada" type="checkbox"
					<?php isset($_REQUEST['check_fec_entrada'])?$_REQUEST['check_fec_entrada']='true':''?>></input>
				<label for="fec_ent_busq">Fecha Entrada:</label>
				<select id="diaEnt_busq" name="diaEnt_busq"><?php echo elegirDia($_REQUEST['diaEnt_busq']);?></select>
				<label for="mesEnt_busq" id="label_mesEnt_busq">/</label>
				<select id="mesEnt_busq" name="mesEnt_busq"><?php echo elegirMes($_REQUEST['mesEnt_busq']);?></select>
				<label for="annoEnt_busq" id="label_annoEnt_busq">/</label>
				<select id="annoEnt_busq" name="annoEnt_busq"><?php echo elegirAnno($_REQUEST['annoEnt_busq']);?></select>
				
				<input id="check_fec_salida" name="check_fec_salida" type="checkbox"
				<?php isset($_REQUEST['check_fec_salida'])?$_REQUEST['check_fec_salida']='true':''?>></input>
				<label for="fec_sal_busq">Fecha Salida:</label>
				<select id="diaSal_busq" name="diaSal_busq"><?php echo elegirDia($_REQUEST['diaSal_busq']);?></select>
				<label for="mesSal_busq" id="label_mesSal_busq">/</label>
				<select id="mesSal_busq" name="mesSal_busq"><?php echo elegirMes($_REQUEST['mesSal_busq']);?></select>
				<label for="annoSal_busq" id="label_annoSal_busq">/</label>
				<select id="annoSal_busq" name="annoSal_busq"><?php echo elegirAnno($_REQUEST['annoSal_busq']);?></select>
				
				<button type="submit">Buscar</button>
             </div>
            </div>
		</form>
    </div>
    <br>				
	<div>
		<div id='cuadro'>
		<?php 
			$fec_entrada = unirFecha($_REQUEST['diaEnt_busq'], $_REQUEST['mesEnt_busq'], $_REQUEST['annoEnt_busq']);
			$fec_salida = unirFecha($_REQUEST['diaSal_busq'], $_REQUEST['mesSal_busq'], $_REQUEST['annoSal_busq']);
			
			$f_ent = $fec_entrada->format('d/m/Y');
			$f_sal = $fec_salida->format('d/m/Y');
			
			$query = sentenciaFiltro($_REQUEST['check_dni'], $_REQUEST['DNI_busqueda'],
						$_REQUEST['check_fec_entrada'], $f_ent, $_REQUEST['check_fec_salida'], $f_sal, $query);
						
			//Paginacion

			$page_num = isset($_GET[ "page_num"]) ? (int)$_GET["page_num"] : 1; 
			
			$page_size = isset($_GET["page_size"]) ? (int)$_GET["page_size"] : 3; 
			if ($page_num < 1) $page_num = 1; 
			if ($page_size < 1) $page_size = 3;

			$total = totalQuery($conexion, $query); 
			$total_pages = ($total / $page_size); 
			if ($total % $page_size > 0) $total_pages++;// resto de la división $total_pages++; 
			if ($page_num > $total_pages) $page_num = 1;
			
			for($page = 1; $page <= $total_pages; $page++) {
				 if ($page == $page_num){ //página actual
			?>
			<span class="current"><?=$page?></span>
			<?php } else { //resto de páginas ?> 
				<a href="../ocupacion/Ocupacion.php?page_num=<?=$page?>&
					page_size=<?=$page_size?>"><?=$page?></a>
			<?php } }
			?><form id= "mostrando" method="get" action="../ocupacion/Ocupacion.php"> 
					<input id="page_num" name="page_num" type="hidden" value="<?=$page_num?>"/> 
					Mostrando 
					<input id="page_size" name="page_size" type="number" min="1" max="<?=$total?>" value="<?=$page_size?>" autofocus="autofocus" /> 
					entradas de <?=$total?> <input type= "submit" value="Cambiar" /> 
					<br>
				</form>	
			</div>
				<br>
				<div class="tablaOcupacion" >
	                <table >
	                	<th>DNI</th> <th>Nombre</th><th>Apellidos</th> <th>Fecha de entrada</th><th>Fecha de salida</th><th>Modificar</th><th>Eliminar</th>
					 </tr> 
					<?php $filas = paginacionOcupacion($conexion, $query, $page_num, $page_size);
					
						if(!empty($filas)){
							foreach($filas as $fila) {
								$id_ocupacion = $fila['ID_OCUPACION'];?> 
							<tr class="Cliente"> 
								<td><?=$fila['DNI']?> </td>
								<td><?=$fila['NOMBRE']?></td>
								<td><?=$fila['APELLIDOS']?></td> 
								<td><?=$fila['FEC_ENTRADA']?></td>
								<td><?=$fila['FEC_SALIDA']?></td> <!--a href="pagina2.php?var=<?php echo $variable;  // <a href="pagina2.php?var=<?php echo $variable; ?>"/> -->
								<td style="vertical-align:middle; text-align:center";><a href="../ocupacion/formOcupacion.php?modificar=<?php echo $id_ocupacion; ?>"><img src="../css/images/modifi.png" alt="" /></a></td>
								<td style="vertical-align:middle; text-align:center";><a href="../general/GestionarBD.php?eliminar=<?php echo $id_ocupacion; ?>" onclick="return confirm('Esta seguro que desea borrar la reserva?')"><img src="../css/images/borr.png" alt="" /></a></td>
							</tr>
							 <?php } //fin foreach
						}else{
							 echo "No hay ninguna ocupacion";
						}?>
	                </table>
	            </div>
            </div>
			
		<?php ?>
		<a href="../ocupacion/FormOcupacion.php"><input type="submit" value="Nueva Ocupacion"></input></a>
		<a href="../administracion/eliminarSesion.php"><input type="submit" value="Volver"></input></a>
	</div>
	</div>
	</div>
</section>

<?php require_once '../layouts/footer.php';
	CerrarConexion($conexion);
?>
