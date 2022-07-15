<?php

include('conexion.php');
$encontro= false;

$nitocc = $_POST['nitocc'];
$consulta = mysqli_query($conexion, "SELECT nitocc FROM Cliente WHERE nitocc='$nitocc'");
if(mysqli_num_rows($consulta)>0)
{
	if(isset($_POST['nitocc']))
	{
		$nitocc = $_POST["nitocc"];
		$borrado = mysqli_query($conexion, "DELETE FROM Cliente WHERE nitocc = '$nitocc'");
		$encontro = true;
	}
	else
	{
		echo "<p>no existe un dato regitrado!..</p>";
	}
}

if(isset($_POST['nroFactura']))
{
	$nroFactura = $_POST["nroFactura"];		
	$borrado = mysqli_query($conexion, "DELETE FROM Factura WHERE nroFactura = '$nroFactura'");
	$encontro= true;
}

if(isset($_POST['nroRecibo']))
{
	$nroRecibo = $_POST['nroRecibo'];
	$borrado = mysqli_query($conexion, "DELETE FROM Pago WHERE nroRecibo = '$nroRecibo'");
	$encontro= true;
}

?>