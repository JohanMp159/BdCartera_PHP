<?php


include('conexion.php');

$listado = mysqli_query($conexion, "SELECT * FROM Pago");
if(mysqli_num_rows($listado)>0)
{
	echo "<table border='1'>
			<th>Nro Recibo</th>
			<th>Nro Factura</th>
			<th>Fecha</th>
			<th>Valor Abonado</th>";
			while($registro=mysqli_fetch_array($listado,MYSQLI_ASSOC))
			{
				echo "<tr>";
					echo "<td>".$registro['nroRecibo']."</td>";
					echo "<td>".$registro['nroFactura']."</td>";
					echo "<td>".$registro['fecha']."</td>";
					echo "<td>".$registro['valorAbono']."</td>";
				echo "</tr>";
			}
		echo "</table> <br/>";
}
else
{
	echo "<p>No existen registros...</p>";
}



$listado = mysqli_query($conexion, "SELECT * FROM Factura");
if(mysqli_num_rows($listado)>0)
{
	echo "<table border='1'>
			<th>Nitocc</th>
			<th>Nro Factura</th>
			<th>Fecha</th>
			<th>Forma Pago</th>
			<th>Valor Factura</th>";
			while($registro=mysqli_fetch_array($listado,MYSQLI_ASSOC))
			{
				echo "<tr>";
					echo "<td>".$registro['nitocc']."</td>";
					echo "<td>".$registro['nroFactura']."</td>";
					echo "<td>".$registro['fecha']."</td>";
					echo "<td>".$registro['formaPago']."</td>";
					echo "<td>".$registro['vlrFactura']."</td>";
				echo "</tr>";
			}
	echo "</table> <br/>";
}
else
{
	echo "<p>No existen registros...</p>";
}


$listado = mysqli_query($conexion, "SELECT * FROM Cliente");
if(mysqli_num_rows($listado)>0)
{
	echo "<table border='1'>
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
else
{
	echo "<p>No existen registros...</p>";
}

?>