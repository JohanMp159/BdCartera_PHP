<?php

include ('conexion.php');
$busqueda = false;
if(isset($_POST['nroFactura']))
{
	$nitocc = "";
	$fecha = "";
	$formaPago = "";
	$vlrFactura = "";

	$nroFactura = $_POST['nroFactura'];
	$consulta = mysqli_query($conexion, "SELECT * FROM Factura WHERE nroFactura = '$nroFactura'");
	if(mysqli_num_rows($consulta)>0)
	{
		$busqueda=true;
		while($reg = mysqli_fetch_array($consulta, MYSQLI_ASSOC))
		{
			$nitocc = $reg["nitocc"];
			$fecha = $reg["fecha"];
			$formaPago = $reg["formaPago"];
			$vlrFactura = $reg["vlrFactura"];
		}
	}
}
if($busqueda)
{
	echo $nitocc."°".$fecha."°".$formaPago."°".$vlrFactura;
} else 
{
	echo "";
}

?>