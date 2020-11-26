<?php

// Conexión con base de datos por medio de mysqli y registro de datos en tabla
    //Datos de conexión con base de datos
	$usuario = "epiz_27311741";
	$password = "OEd2kyGsr6V8o";
	$servidor = "sql300.epizy.com";
	$basededatos = "epiz_27311741_gonzaloverdia";
	
	// creación de la conexión a la base de datos con mysql_connect()
	$conexion = mysqli_connect( $servidor, $usuario, $password, $basededatos ) or die ("No se ha podido conectar al servidor de Base de datos");

    $sql = "INSERT INTO Estudiantes (NOMBRE, APELLIDO, CORREO)
    VALUES ('John', 'Doe', 'john@example.com')";

    if ($conexion->query($sql) === TRUE) {
    echo "Nuevo registro creado con éxito";
    } else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
    }

    $conexion->close();
?> 
