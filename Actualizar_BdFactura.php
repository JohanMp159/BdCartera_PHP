<?php

include('Conexion.php');
$busqueda=false;
if(isset($_POST['nroFactura']))
{
	$nroFactura = $_POST['nroFactura'];
	$nitocc = $_POST['nitocc'];
	$fecha = $_POST['fecha'];
	$formaPago = $_POST['formaPago'];
	$vlrFactura = $_POST['vlrFactura'];

	$actualizar = mysqli_query($conexion, "UPDATE Factura SET nitocc='$nitocc',fecha='$fecha',formaPago='$formaPago',vlrFactura='$vlrFactura' WHERE nroFactura='$nroFactura'");
	$busqueda=true;
}

?>