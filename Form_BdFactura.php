<?php
	include ('conexion.php');
	//Aquí está siendo reaunada la sesion.
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>BdCartera_Factura</title>
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
<div style="text-align: center;" >
	<form>
		<h2>dbo.Factura</h2>
		<table style="width: 300px; margin: auto;">
			<tr>
				<td style="text-align: left;"> Nro Factura </td>
				<td> <input type="text" name="txtnroFactura" id="txtnroFactura"> </td>
			</tr>
			<tr>
				<td style="text-align: left;"> Nitocc </td>
				<td> <input type="text" name="txtnitocc" id="txtnitocc"> </td>
			</tr>
			<tr>
				<td style="text-align: left;"> Fecha </td>
				<td> <input type="date" name="txtfecha" id="txtfecha" style="width: 168px;"> </td>
			</tr>
			<tr>
				<td style="text-align: left;"> Forma Pago </td>
				<td> <input type="text" name="txtformaPago" id="txtformaPago"> </td>
			</tr>
			<tr>
				<td style="text-align: left;"> Valor Factura </td>
				<td> <input type="number" name="txtvlrFactura" id="txtvlrFactura"> </td>
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
			//Listar
			$('#btnlistar').click(function(){
				$.ajax({
					type:"POST",
					url:"Listar_BdFactura.php",
					success:function(resp){
						$('#mensaje').text('');
						$('#listadoClientes').html(resp);
					}
				});
			});
			//Agregar
			$("#btnagregar").click(function()
			{
				if($("#txtnroFactura").val()=="" || $("#txtnitocc").val()=="" || $("#txtfecha").val()=="" || $("#txtformaPago").val()=="" || $("#txtvlrFactura").val()=="")
				{
					alert('Debe de completar todos los campos...');
				}
				else
				{
					$nroFactura = $("#txtnroFactura").val();
					$nitocc = $("#txtnitocc").val();
					$fecha = $("#txtfecha").val();
					$formaPago = $("#txtformaPago").val();
					$vlrFactura = $("#txtvlrFactura").val();
					$.ajax({
						type:"POST",
						url:"Agregar_BdFactura.php",
						data:{
							nroFactura:$nroFactura,
							nitocc:$nitocc,
							fecha:$fecha,
							formaPago:$formaPago,
							vlrFactura:$vlrFactura,
							agregado:1
						},
						success:function(datos){
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
				$nroFactura=$('#txtnroFactura').val();
				$.ajax({
					type:"POST",
					url:'buscar_BdFactura.php',
					data:
					{
						nroFactura:$nroFactura
					},
					success:function(datos){
						if($nroFactura=="")
						{
							$('#mensaje').text("Ingrese un número de Factura");
						}
						else{
							if(datos!='')
							{
								var arrayDatos = datos.split("°")
								$('#txtnitocc').val(arrayDatos[0]);
								$('#txtfecha').val(arrayDatos[1]);
								$('#txtformaPago').val(arrayDatos[2]);
								$('#txtvlrFactura').val(arrayDatos[3]);
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
			//Actualizar
			$('#btnactualizar').click(function(){
				$nroFactura = $("#txtnroFactura").val();
				$nitocc = $("#txtnitocc").val();
				$fecha = $("#txtfecha").val();
				$formaPago = $("#txtformaPago").val();
				$vlrFactura = $("#txtvlrFactura").val();
				$.ajax({
					type:"POST",
					url:"Actualizar_BdFactura.php",
					data:{
						nroFactura:$nroFactura,
						nitocc:$nitocc,
						fecha:$fecha,
						formaPago:$formaPago,
						vlrFactura:$vlrFactura
					},
					success:function(resp){
						if($nitocc=='')
						{
							$('#mensaje').text("Indique un número de factura, busque & luego actualice!..")
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
				$nroFactura = $('#txtnroFactura').val();
				$.ajax({
					type:"POST",
					url:"Eliminar.php",
					data:{
						nroFactura:$nroFactura
					},
					success:function(datos){
						if($nroFactura=='')
						{
							$('#mensaje').text("Indique un número de factura, busque & luego elimine.")
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