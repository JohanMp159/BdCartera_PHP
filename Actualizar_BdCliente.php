<?php

include('Conexion.php');
$busqueda=false;
if(isset($_POST['nitocc']))
{
	$nitocc = $_POST['nitocc'];
	$razonSocial = $_POST['razonSocial'];
	$direccion = $_POST['direccion'];
	$telefono = $_POST['telefono'];
	$cupoCredito = $_POST['cupoCredito'];

	$actualizar = mysqli_query($conexion, "UPDATE Cliente SET razonSocial='$razonSocial',direccion='$direccion',telefono='$telefono',cupoCredito='$cupoCredito' WHERE nitocc='$nitocc'");
	$busqueda=true;
}
if($busqueda)
{
	$nitocc = $_POST['nitocc'];
	$listado = mysqli_query($conexion, "SELECT * FROM Cliente WHERE nitocc='$nitocc'");
	echo "<p style='text-align:left;'> Se actualizo el siguiente registro!.. </p>
			<table border='1'>
			<th>Nitocc</th>
			<th>Razon Social</th>
			<th>Dirección</th>
			<th>Teléfono</th>
			<th>Cupo Credito</th>";
			while($registro=mysqli_fetch_array($listado,MYSQLI_ASSOC))
			{
				echo "<tr>";
					echo "<td>".$registro['nitocc']."</td>";
					echo "<td>".$registro['razonSocial']."</td>";
					echo "<td>".$registro['direccion']."</td>";
					echo "<td>".$registro['telefono']."</td>";
					echo "<td>".$registro['cupoCredito']."</td>";
				echo "</tr>";
			}
			echo "</table>";
}

?>