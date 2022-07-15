<?php

include ('conexion.php');

if(isset($_POST['agregado']))
{
	$nroRecibo = $_POST['nroRecibo'];
	$nroFactura = $_POST['nroFactura'];
	$fecha = $_POST['fecha'];
	$valorAbono = $_POST['valorAbono'];

	mysqli_query($conexion, "insert into Pago (nroRecibo,nroFactura,fecha,valorAbono) values('$nroRecibo','$nroFactura','$fecha','$valorAbono')");
}


?>
