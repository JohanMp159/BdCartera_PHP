<?php
	include ('conexion.php');
	//Aquí está siendo reaunada la sesion.
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>BdCartera_Pago</title>
	<link rel="stylesheet" type="text/css" href="Css/Css.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<div style="text-align: right;">
    <strong>Bienvenido:  <?php echo $_SESSION['usuario'] ?> </strong> <br>
    <a style="margin-top: 0px;" href="cerrar_sesion.php">Cerrar sesión</a>
</div>
<div class="container">
	<div>	
		<h1>Database Cartera</h1>
		<nav>
			<ul>
				<li> <a href="Form_BdCliente.php" class="menu__link">dbo.Cliente</a></li>
				<li> <a href="Form_BdFactura.php" class="menu__link">dbo.Factura</a></li>
				<li> <a href="Form_BdPago.php" class="menu__link">dbo.Pago</a></li>
			</ul>
		</nav>
		<p>Indique en el menú superior la tabla que desea consultar.</p>
	</div>
</div>
<div style="text-align:center;" >
		<form>
		<h2>dbo.Pago</h2>
		<table style="width: 300px; margin: auto;">
			<tr>
				<td style="text-align: left;"> Nro Recibo </td>
				<td> <input type="text" name="txtnroRecibo" id="txtnroRecibo"> </td>
			</tr>
			<tr>
				<td style="text-align: left;"> Nro Factura </td>
				<td> <input type="text" name="txtnroFactura" id="txtnroFactura"> </td>
			</tr>
			<tr>
				<td style="text-align: left;"> Fecha </td>
				<td> <input type="date" name="txtfecha" id="txtfecha" style="width: 168px;"> </td>
			</tr>
			<tr>
				<td style="text-align: left;"> Valor Abonado </td>
				<td> <input type="text" name="txtvalorAbono" id="txtvalorAbono"> </td>
			</tr> 
			<tr>
				<td colspan="2"> 
				<input type="button" name="btnagregar" id="btnagregar" value="Agregar">
				<input type="button" name="btnborrar" id="btnborrar" value="Eliminar">
				</td>
			</tr>
			<tr>	
				<td colspan="2">
				<input type="button" name="btnlistar" id="btnlistar" value="Listar">
				<input type="button" name="btnbuscar" id="btnbuscar" value="Buscar">
				<input type="button" name="btnactualizar" id="btnactualizar" value="Actualizar">	
				</td>	
			</tr>
		</table>
	</form>
	<br/>
	<div id="mensaje" style="background: #F3F3F3; display: inline;"> </div>
	<div id="listadoClientes" style="width:560px;text-align:center;margin:auto;padding-left:170px;"> </div>
</div>
	<script type="text/javascript">
		$(document).ready(function()
		{
			$("#btnagregar").click(function()
			{
				if($("#txtnroRecibo").val()=="" || $("#txtnroFactura").val()=="" || $("#txtfecha").val()=="" || $("#txtvalorAbono").val()=="")
				{
					alert('Debe de completar todos los campos...');
				}
				else
				{
					$nroRecibo = $("#txtnroRecibo").val();
					$nroFactura = $("#txtnroFactura").val();
					$fecha = $("#txtfecha").val();
					$valorAbono = $("#txtvalorAbono").val();
					$.ajax({
						type:"POST",
						url:"Agregar_BdPago.php",
						data:{
							nroRecibo:$nroRecibo,
							nroFactura:$nroFactura,
							fecha:$fecha,
							valorAbono:$valorAbono,
							agregado:1
						},
						success:function(datos)
						{
							$('#listadoClientes').text("");
							if(datos=="")
							{
								$('#mensaje').text('Datos insertados correctamente..');
							}
						}
					});
				}
			});
			//Buscar
			$('#btnbuscar').click(function(){
				$nroRecibo=$('#txtnroRecibo').val();
				$.ajax({
					type:"POST",
					url:'buscar_BdPago.php',
					data:
					{
						nroRecibo:$nroRecibo
					},
					success:function(datos){
						if($nroRecibo=="")
						{
							$('#mensaje').text("Ingrese un numero de recibo!..");
						}
						else{

							if(datos!='')
							{
								var arrayDatos = datos.split("°")
								$('#txtnroFactura').val(arrayDatos[0]);
								$('#txtfecha').val(arrayDatos[1]);
								$('#txtvalorAbono').val(arrayDatos[2]);
							}
							else
							{
								$('#mensaje').text("No existe una factura registrado en la Bd..");
								$('#mensaje').val("");
								$('#mensaje').val("");
								$('#mensaje').val("");
							}
						}
					}	
				})
				
			});
			//Listar
			$('#btnlistar').click(function(){
				$.ajax({
					type:"POST",
					url:"Listar_BdPago.php",
					success:function(resp){
						$('#mensaje').text('');
						$('#listadoClientes').html(resp);
					}
				});
			});
			//Actualizar
			$('#btnactualizar').click(function(){
				$nroRecibo = $("#txtnroRecibo").val();
				$nroFactura = $("#txtnroFactura").val();
				$fecha = $("#txtfecha").val();
				$valorAbono = $("#txtvalorAbono").val();
				$.ajax({
					type:"POST",
					url:"Actualizar_BdPago.php",
					data:{
						nroRecibo:$nroRecibo,
						nroFactura:$nroFactura,
						fecha:$fecha,
						valorAbono:$valorAbono
					},
					success:function(resp){
						if($nroRecibo=='')
						{
							$('#mensaje').text("Indique un número de recibo, busque & luego actualice!..")
						}
						else
						{
							$('#listadoClientes').text("");
							if(resp=='')
							{
								$('#mensaje').text("Los datos se actualizaron correctamente..");	
							}
							else
							{
								$('#mensaje').text("Hubo un error al actualizar los datos!..");
							}
						}
					}
				});
			});
			//Eliminar
			$('#btnborrar').click(function(){
				$nroRecibo = $('#txtnroRecibo').val();
				$.ajax({
					type:"POST",
					url:"Eliminar.php",
					data:{
						nroRecibo:$nroRecibo
					},
					success:function(datos){
						if($nroRecibo=='')
						{
							$('#mensaje').text("Indique un número de Recibo, busque & luego elimine.")
						}
						else
						{
							$('#listadoClientes').text("");
							if(datos=='')
							{
								if(confirm("Esta seguro que desea elimiar este registro?"))
								{
									$('#mensaje').text("Los datos se eliminaron correctamente..");
								}
							}
						else{
								$('#mensaje').text("Hubo un error al eliminar los datos");
							}								
						}
							
					}
				})
			});

		});
	</script>
</body>
</html>