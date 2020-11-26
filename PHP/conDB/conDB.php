<?php
// Conexión con base de datos por medio de mysqli_connect()
 
    //Datos de conexión con base de datos
	$usuario = "epiz_27311741";
	$password = "OEd2kyGsr6V8o";
	$servidor = "sql300.epizy.com";
	$basededatos = "epiz_27311741_gonzaloverdia";
	
	// creación de la conexión a la base de datos con mysql_connect()
	$conexion = mysqli_connect( $servidor, $usuario, $password ) or die ("No se ha podido conectar al servidor de Base de datos");
	mysqli_close( $conexion );
	


?>