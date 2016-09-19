


<?php require_once '../layouts/header.php'?>
<section><div id='header'>
			<div id="main">
				<div class="cols three-cols">
					<p>
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
        <img style="border:0;width:88px;height:31px"
            src="http://jigsaw.w3.org/css-validator/images/vcss"
            alt="¡CSS Válido!" />
    </a>
</p>
	                <h3>P&aacute;gina de descripci&oacute;n</h3>
	               	</div>
	              		<p>Esta aplicación web esta destinada tanto a clientes externos como a trabajadores internos de la empresa.
	              		<br>
	              		Se basa en una interfaz común para ambos entornos donde premia la amigabilidad del entorno para el usuario.
						<br><br><b>Entorno Público:</b><br><br>
						La parte Publica, la cual es accesible para todo usuario de internet, se compone de un menú principal fijo 
						situado en la parte superior de la página, desde el cual se puede acceder en todo momento a las distintas 
						opciones que proporciona la aplicación</p>

				        
						<br><br><p>En <b>menú->Inicio</b>  tenemos información y grandes rasgos sobre “TheSpotCentralHostel” con diversos 
							artículos de interés sobre sus características:</p><br>
		  
							<A name="salacomun">Sala Comun</a>
							<p>breve texto enumerado en el que se reflejan los servicios del hostel</p>
							<A name="facilidades">Facilidades</a>
							<p>Explicación sobre los servicios de los que dispone el hostel</p>
							
						<br><br><p>En <b>menú->TheHostel</b>  Este modulo lo hemos dedicado basicamente a mostrarle al usuario 
							una vista mas cercana del Hostel, su ambiente juvenil y familiar, y el aspecto físico de las instalaciones:</p><br>
							
							<A name="galeria">Galeria de fotos: </a>
              	  			Este es el único espacio del modulo, el cual contiene una galeria de fotos para que el usuario reciba un mensaje 
              	  			visual claro de lo que es "The Spot Central Hostel"</p> 
             
						<br><br><p>En <b>menú->Reservas</b>  Apartado en el cual se tratan "todos" los rasgos referentes a la reservas online para una estancia
							en el Hostel.: </p><br>
              	  		
              	  		<A name="reservas">Formulario de creaci&oacute;n de reservas:</a>
              	  			<p>Haciendo "clic" en <b>nueva reserva</b> puede acceder al formulario de <b>Reservas</b>.<br> 
              	  			El formulario consta tanto de datos personales, necesarios para dar de alta al cliente (en el caso de que se llege a terminar el proceso 
              	  			de reserva convirtiendose en euna ocupacion), como de datos referidos a la reserva de habitaciones, y fechas de entrada y salida.<br>
              	  			Rellenando este formulario el hostel recibe la solicitud de reserva a la espera de confirmarla en personay convertirla en "ocupacion"</p> 
              	  		
              	  		<br><br><p>En <b>menú->Actividades</b>  Apartado en el cual se tratan todos los rasgos referentes a la actividades que ofrece el hostel como a las 
              	  			reservas online de las mismas: </p><br>
              	  			
              	  			<A name="formActividad">Formulario de actividades:</a>
              	  			<p>Haciendo "clic" en <b>Actividades</b> puede acceder al formulario de <b>Activiades</b> y apuntarse a una activ.<br> 
              	  			El formulario consta tanto de datos personales, necesarios para dar de alta al cliente, como de datos referidos a la actividad a elegir.<br>
              	  			Rellenando este formulario el hostel recibe la solicitud y lo guarda como cleinte de dicha activiadad</p> 
              	  			
              	  			<A name="Consultar Actividades">Mis actividades:</a>
              	  			<p>Haciendo "clic" en <b>Mis Actividades</b> tenemos la opcion de observar si estamos registrados en alguna actividad activa (que no halla caducado).<br>
              	  				El procedimiento para esta consulta es simplemente introducir nuestro DNI, ya que al reservarla tubimos que darlo en el formulario de reservas de actividades.
 								Tras realizar la búsqueda obtendremos todas las actividades en las que estemos registrados</p> 
              	  		<br><br><p>En <b>menú->Información: </b>  Este enlace te dirige a esta misma pagina de descripicion de la aplicacion web </p><br>
              	  		<br><br><p>En <b>menú->Contacto: </b>  Ultimo botón del menu en el que el usuario puede ver la localización del Hostel, facilitandoselo mediante un mapa de "googleMaps".
              	  			También puede encontrar en esta sección el telefono por si quisiera contactar con el hostel, y un enlace para enviar 
              	  			un correo electrónico para cualquier cuestión que tubiese</p><br>
              	  			
              	  		
              	  		  </div>
          
        	 </div>
        	 <div class="cols three-cols">
        	 	<b>Entorno Privado:</b><br><br>
						<p>La parte Privada, la cual es accesible solo para los empleados del hostel, se compone de la misma estructura base, como la parte pública, pero tran un login se accede 
						a informacion restringida para el resto de usuarios.
						Para acceder al login tenemos que pinchar en el "footer" sobre el enlace llamado "Administración". Una vez confirmado el usuario y la contraseña, 
						dependiendo de los privilegios de cada usuario, se podran acceder a ciertos datos de la base de datos</p><br>
						<A name="formAdministrador">Formulario de administrador: </A>
						<p>Si el usuario logeado tiene permisos de administrador, tendra acceso tanto a información de ocupación del hostel como a la referente a los empleados.</p>
              	  		<br>
              	  		<A name="ocupacion">Ocupacion:</a>
              	  			<p> En este área podemos obtener una tabla conla ocupación del hostel.
              	  				Podemos realizar busquedas con varios filtros, para concretar y disminuir el rango de resultados visualizados.
              	  				Sobre todas las ocupaciones activas del hostel, mediante esta tabla, tenemos la opción de modificarla o de eliminarla, en el caso de que haya finalizado la estancia.
              	  				Tambien contamos con la opción de "Nueva ocupación" , con la cual se accede a un formulario.</p>
              	  			<br>
              	  		<A name="formOcupacion">Formulario de Ocupacion:</a>
              	  			<p>Mediante este formulario,  administrador hace efectiva una ocupación(o una reserva solicitada) rellenando todos los campos.
              	  				Una vez finalizado el formulario, en la base de datos se actualizan los valores en todas las tablas relacionadas con las ocupaciones de habitaciones y camas 
              	  				y de los clientes.
              	  			<br></p>
              	  			
              	  		<A name="formEmpleado">Formulario de empleados:</a>
              	  			<p> Este formulario, es de acceso exclusivo del usuario "administrador" ya que es en este en el que se accede a los datos personales de los empleados de la empresa
              	  				   		
        	 </div>
</section>

<?php require_once '../layouts/footer.php'?>