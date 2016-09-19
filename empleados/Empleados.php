<?php
	$query ="SELECT * FROM EMPLEADOS JOIN PERSONAS ON EMPLEADOS.DNI = PERSONAS.DNI";
	require_once("../general/GestionarBD.php");
	require_once("../general/GestionBD.php");
	require_once("../general/Funciones.php");
	
	$conexion = CrearConexionBD();
	error_reporting(E_ALL ^ E_NOTICE);
	
?><?php require_once '../layouts/header.php'?>
<section><div id='header'>
					<div id='slider'>
						<a href="informacion.php#empleado"><img src="css/images/exclama.png" alt="" /></a></h2>
						<div id='slider-holder'>
					
	<div>
		<div id="mostrar">
			
			<div id="cuadro1">
				<div id="Busqueda">
	<div>		
		<form id="BusquedaEmpleado" action="Empleados.php">
			<label for="DNI_busq_Emp">DNI:</label>
			<input id="DNI_busq_Emp" name="DNI_busq_Emp" type="text" maxlength="9" size="9"/>
			<button type="submit">Buscar</button>
		</form>
    </div>
    <br>	
    <div>
		<div id='cuadro'>
		<?php 
		//paginacion
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
				<a href="../empleados/Empleados.php?page_num=<?=$page?>&
					page_size=<?=$page_size?>"><?=$page?></a>
			<?php } }
			?><form id= "mostrando" method="get" action="../empleados/Empleados.php"> 
					<input id="page_num" name="page_num" type="hidden" value="<?=$page_num?>"/> 
					Mostrando 
					<input id="page_size" name="page_size" type="number" min="1" max="<?=$total?>" value="<?=$page_size?>" autofocus="autofocus" /> 
					entradas de <?=$total?> <input type= "submit" value="Cambiar" /> 
					<br>
				</form>	
			</div>
			<br>			
	<div>
		<div class="tablaOcupacion" >
			<?php 
			if(!empty($_REQUEST['DNI_busq_Emp'])){
				$dniEmp = $_REQUEST['DNI_busq_Emp'];
				$query = "SELECT * FROM EMPLEADOS JOIN PERSONAS ON EMPLEADOS.DNI = PERSONAS.DNI WHERE EMPLEADOS.DNI='$dniEmp'";
			}
			
		?>	
		
	                <table >
	                	<th>DNI</th> <th>Nombre</th><th>Apellidos</th><th>Fecha de alta</th><th>Fecha de baja</th><th>Modificar</th><th>Eliminar</th> 
						
						<?php $lista = paginacionOcupacion($conexion, $query, $page_num, $page_size);
					
						//<?php $lista = devuelveListaEmpleados($conexion, $query); 
						
						if(!empty($lista)){
							foreach($lista as $fila) {
								$id_empleado = $fila['ID_EMPLEADO'];
						?><tr class="Empleados"> 
							<td><?=$fila['DNI']?> </td>
							<td><?=$fila['NOMBRE']?></td>
							<td><?=$fila['APELLIDOS']?></td> 
							<td><?=$fila['FEC_ALTA']?> </td>
							<td><?=$fila['FEC_BAJA']?></td>
							<td style="vertical-align:middle; text-align:center";><a href="../empleados/FormEmpleado.php?modificarE=<?php echo $id_empleado; ?>"><img src="../css/images/modifi.png" alt="" /></a></td>
							<td style="vertical-align:middle; text-align:center";><a href="../general/GestionarBD.php?eliminarE=<?php echo $id_empleado; ?>" 
								onclick="return confirm('Esta seguro que desea borrar el empleado?')"><img src="../css/images/borr.png" alt="" /></a></td>
							
						</tr>
							 <?php } 
						}else{
							 echo "No hay ningun empleado";
						}?>
	                </table>
	     </div>
	     <a href="../empleados/FormEmpleado.php"><input type="submit" value="Nuevo Empleado"></input></a>
	     <a href="../administracion/eliminarSesion.php"><input type="submit" value="Volver"></input></a>
</section>
<?php require_once '../layouts/footer.php';
	CerrarConexionBD($conexion);
?>