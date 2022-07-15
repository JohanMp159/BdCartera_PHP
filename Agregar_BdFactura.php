<?php

include ('conexion.php');

if(isset($_POST['agregado']))
{
	$nroFactura = $_POST['nroFactura'];
	$nitocc = $_POST['nitocc'];
	$fecha = $_POST['fecha'];
	$formaPago = $_POST['formaPago'];
	$vlrFactura = $_POST['vlrFactura'];

	mysqli_query($conexion, "insert into Factura (nroFactura,nitocc,fecha,formaPago,vlrFactura) values('$nroFactura','$nitocc','$fecha','$formaPago','$vlrFactura')");
}


?>
