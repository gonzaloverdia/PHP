<?php 
	$texto = $_POST['texto'];
	$ch = curl_init("https://www.google.com/search?q=".$texto);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$respuesta = curl_exec($ch);
	echo $respuesta;


 ?>