<?php
 //Datos de conexión con base de datos
	$usuario = "epiz_27311741";
	$password = "OEd2kyGsr6V8o";
	$servidor = "sql300.epizy.com";
	$basededatos = "epiz_27311741_gonzaloverdia";
	
	// creación de la conexión a la base de datos con mysql_connect()
	$conexion = mysqli_connect( $servidor, $usuario, $password, $basededatos ) or die ("No se ha podido conectar con el servidor de la Base de datos");
	
	
    $consulta = "SELECT * FROM Estudiantes";
	$resultado = mysqli_query( $conexion, $consulta ) or die ( "no se ha podido realizar la consulta a la base de datos");
	
	// Motrar el resultado de los registro de la base de datos
	// Encabezado de la tabla
	echo "<table>";
	echo "<tr>";
    echo "<th>ID</th>";
	echo "<th>Nombre</th>";
	echo "<th>Apellido</th>";
    echo "<th>Correo</th>";
	echo "</tr>";
	
	// Bucle while que recorre cada registro y muestra cada campo en la tabla.
	while ($columna = mysqli_fetch_array( $resultado ))
	{
		echo "<tr>";
		echo "<td>" . $columna['ID'] . "</td>" . "<td>" . $columna['NOMBRE'] . "</td>" . "<td>" . $columna['APELLIDO'] . "</td>" . "<td>" . $columna['CORREO'] . "</td>" ;
		echo "</tr>";
	}
	
	echo "</table>"; // Fin de la tabla

	// cerrar conexión de base de datos
	mysqli_close( $conexion );
    ?>