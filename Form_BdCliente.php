<?php
	include ('conexion.php');
	//Aquí está siendo reaunada la sesion.
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ingreso de datos a BdCartera</title>
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
		<h2>dbo.Cliente</h2>
		<table style="width: 300px; margin: auto;">
			<tr>
				<td style="text-align: left;" for="ver"> Nitocc </td>
				<td> <input type="text" name="txtnitocc" id="txtnitocc" onblur="validarnitocc(this);"> <span id="comprobarnitocc"></span> </td>
			</tr>
			<tr>
				<td style="text-align: left;"> Razon Social </td>
				<td> <input type="text" name="txtrazonSocial" id="txtrazonSocial"> </td>
			</tr>
			<tr>
				<td style="text-align: left;"> Dirección </td>
				<td> <input type="text" name="txtdireccion" id="txtdireccion"> </td>
			</tr>
			<tr>
				<td style="text-align: left;"> Teléfono </td>
				<td> <input type="number" name="txttelefono" id="txttelefono"> </td>
			</tr>
			<tr>
				<td style="text-align: left;"> Cupo Credito </td>
				<td> <input type="text" name="txtcupoCredito" id="txtcupoCredito"> </td>
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
			//Agregar
			$("#btnagregar").click(function()
			{
				if($("#txtnitocc").val()=="" || $("#txtrazonSocial").val()=="" || $("#txtdireccion").val()=="" || $("#txttelefono").val()=="" || $("#txtcupoCredito").val()=="")
				{
					alert('Debe de completar todos los campos...');
				}
				else
				{
					$nitocc = $("#txtnitocc").val();
					$razonSocial = $("#txtrazonSocial").val();
					$direccion = $("#txtdireccion").val();
					$telefono = $("#txttelefono").val();
					$cupoCredito = $("#txtcupoCredito").val();
					$.ajax({
						type:"POST",
						url:"Agregar_BdCliente.php",
						data:{
							nitocc:$nitocc,
							razonSocial:$razonSocial,
							direccion:$direccion,
							telefono:$telefono,
							cupoCredito:$cupoCredito,
							agregado:1
						},
						success:function(datos){
							$('#listadoClientes').text("");
							if(datos=="")
							{
								$('#txtnitocc').val("");
								$('#txtrazonSocial').val("");
								$('#txtdireccion').val("");
								$('#txttelefono').val("");
								$('#txtcupoCredito').val("");
								$('#mensaje').text('Datos insertados correctamente..');
							}
							else
							{
								$('#mensaje').text('El cliente ya se encuentra registrado en la Bd!..');
							}
						}
					});
				}
			});
			//Buscar
			$('#btnbuscar').click(function(){
				$nitocc=$('#txtnitocc').val();
				$.ajax({
					type:"POST",
					url:'buscar_BdCliente.php',
					data:
					{
						nitocc:$nitocc
					},
					success:function(datos){
						if($nitocc=="")
						{
							$('#mensaje').text("Ingrese un nitocc!..");
							$('#listadoClientes').text("");
						}
						else{
							if(datos!='')
							{
								var arrayDatos = datos.split("°")
								$('#txtrazonSocial').val(arrayDatos[0]);
								$('#txtdireccion').val(arrayDatos[1]);
								$('#txttelefono').val(arrayDatos[2]);
								$('#txtcupoCredito').val(arrayDatos[3]);
							}
							else
							{
								$('#mensaje').text("El Cliente no se encuentra registrado en la Bd..");
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
					url:"Listar_BdCliente.php",
					success:function(resp){
						$('#mensaje').text('');
						$('#listadoClientes').html(resp);
					}
				});
			});
			//Actualizar
			$('#btnactualizar').click(function(){
				$nitocc = $("#txtnitocc").val();
				$razonSocial = $("#txtrazonSocial").val();
				$direccion = $("#txtdireccion").val();
				$telefono = $("#txttelefono").val();
				$cupoCredito = $("#txtcupoCredito").val();
				$.ajax({
					type:"POST",
					url:"Actualizar_BdCliente.php",
					data:{
						nitocc:$nitocc,
						razonSocial:$razonSocial,
						direccion:$direccion,
						telefono:$telefono,
						cupoCredito:$cupoCredito
					},
					success:function(resp){
						if($nitocc=='')
						{
							$('#mensaje').text("Indique un nitocc, busque & luego actualice!..");
						}
						else
						{
							$('#listadoClientes').text("");
							if(resp=='')
							{
								$('#mensaje').text("Hubo un error al actualizar los datos!..");
							}
							else
							{
								$('#mensaje').text("Los datos se actualizaron correctamente!..");
								$('#listadoClientes').html(resp);
							}
						}
					}
				});
			});
			//Eliminar
			$('#btnborrar').click(function()
			{
				$nitocc = $('#txtnitocc').val();
				if($nitocc=='')
				{
					$('#mensaje').text("Indique un nitocc, busque & luego elimine.");
					$('#listadoClientes').text("");
				}
				else
				{
					if(confirm("Confirma la eliminación del regitro?"))
					{
						$nitocc = $('#txtnitocc').val();
						$.ajax({
						type:"POST",
						url:"Eliminar.php",
						data:{
							nitocc:$nitocc
					},
					success:function(datos)
					{
						$('#listadoClientes').text("");
						if(datos=='')
						{
							$('#mensaje').text("Los datos se eliminaron correctamente..");
							$('#txtnitocc').val("");
							$('#txtrazonSocial').val("");
							$('#txtdireccion').val("");
							$('#txttelefono').val("");
							$('#txtcupoCredito').val("");
						}
						else
						{
							$('#listadoClientes').text("");
							$('#mensaje').text("Hubo un error al eliminar los datos!..");
						}															
					}
					});
				}
			}	
			});

		});
	</script>
</body>
</html>