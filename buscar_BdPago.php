<?php

include ('conexion.php');
$busqueda = false;
if(isset($_POST['nroRecibo']))
{
	$nroFactura = "";
	$fecha = "";
	$valorAbono = "";

	$nroRecibo = $_POST['nroRecibo'];
	$consulta = mysqli_query($conexion, "SELECT * FROM Pago WHERE nroRecibo = '$nroRecibo'");
	if(mysqli_num_rows($consulta)>0)
	{
		$busqueda=true;
		while($reg = mysqli_fetch_array($consulta, MYSQLI_ASSOC))
		{
			$nroFactura = $reg["nroFactura"];
			$fecha = $reg["fecha"];
			$valorAbono = $reg["valorAbono"];
		}
	}
}
if($busqueda)
{
	echo $nroFactura."°".$fecha."°".$valorAbono;
} else 
{
	echo "";
}

?>