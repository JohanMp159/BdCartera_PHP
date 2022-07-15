<?php

include ('conexion.php');
$busqueda = false;
if(isset($_POST['nitocc']))
{
	$razonSocial = "";
	$direccion = "";
	$telefono = "";
	$cupoCredito = "";

	$nitocc = $_POST['nitocc'];
	$consulta = mysqli_query($conexion, "SELECT * FROM Cliente WHERE nitocc = '$nitocc'");
	if(mysqli_num_rows($consulta)>0)
	{
		$busqueda=true;
		while($reg = mysqli_fetch_array($consulta, MYSQLI_ASSOC))
		{
			$razonSocial = $reg["razonSocial"];
			$direccion = $reg["direccion"];
			$telefono = $reg["telefono"];
			$cupoCredito = $reg["cupoCredito"];
		}
	}
}
if($busqueda)
{
	echo $razonSocial."°".$direccion."°".$telefono."°".$cupoCredito;
} else 
{
	echo "";
}

?>