<?php
	require_once ('../general/Funciones.php');
	session_start();
	limpia_variables_sesion();
    //session_destroy();
	header("Location:login.php");
?>