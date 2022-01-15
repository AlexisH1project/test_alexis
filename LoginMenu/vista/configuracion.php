
<?php

$host = "bxkpxk0z09rkv3jqydcc-mysql.services.clever-cloud.com";
$usuario = "uxpu5ymrz1zwvgtv";
$contrasena = "oCiqGxLJ1CERikPoC12j";
$nombre_bd = "bxkpxk0z09rkv3jqydcc";

$conexion = mysqli_connect($host, $usuario, $contrasena, $nombre_bd);

if(!$conexion){

	die("La conexion fallo: " . mysqli_connect_error());
	
}

?>
