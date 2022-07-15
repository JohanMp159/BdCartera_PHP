<?php

include ('conexion.php');
$nitocc = $_POST['nitocc'];
$consulta = mysqli_query($conexion, "SELECT * FROM Cliente WHERE nitocc='$nitocc'");
if(mysqli_num_rows($consulta)==0)
{
	if(isset($_POST['agregado']))
	{
		$nitocc = $_POST['nitocc'];
		$razonSocial = $_POST['razonSocial'];
		$direccion = $_POST['direccion'];
		$telefono = $_POST['telefono'];
		$cupoCredito = $_POST['cupoCredito'];
		$agregar= mysqli_query($conexion, "insert into Cliente (nitocc,razonSocial,direccion,telefono,cupoCredito) values('$nitocc','$razonSocial','$direccion','$telefono','$cupoCredito')");
	}
}	
else
{
	
	echo "Dato ya registrado!..";
}

?>
