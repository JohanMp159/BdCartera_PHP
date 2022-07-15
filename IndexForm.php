<?php 
    //Aquí está siendo reaunada la sesion.
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="Css/Css.css">
	<title>Inicio BdCartera</title>
</head>
<body>
<div style="text-align: right;">
    <strong>Bienvenido:  <?php echo $_SESSION['usuario'] ?> </strong> <br>
    <a style="margin-top: 0px;" href="cerrar_sesion.php">Cerrar sesión</a>
</div>
<div class="container">
	<div>	
		<h1>Database Cartera</h1>
		<nav class="nav">
			<ul>
				<li> <a href="Form_BdCliente.php" class="menu__link">dbo.Cliente</a></li>
				<li> <a href="Form_BdFactura.php" class="menu__link">dbo.Factura</a></li>
				<li> <a href="Form_BdPago.php" class="menu__link">dbo.Pago</a></li>
			</ul>
		</nav>
		<p>Indique en el menú superior la tabla que desea consultar.</p>
	</div>
</div>
</body>
</html>