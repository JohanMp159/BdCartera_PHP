<?php

include('Conexion.php');
$busqueda=false;
if(isset($_POST['nroRecibo']))
{
	$nroRecibo = $_POST['nroRecibo'];
	$nroFactura = $_POST['nroFactura'];
	$fecha = $_POST['fecha'];
	$valorAbono = $_POST['valorAbono'];

	$actualizar = mysqli_query($conexion, "UPDATE Pago SET nroFactura='$nroFactura',fecha='$fecha',valorAbono='$valorAbono'WHERE nroRecibo='$nroRecibo'");
	$busqueda=true;
}

?>