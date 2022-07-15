<?php
 	$servidor='localhost';
    $basedatos='cartera';
    $usuario='root';
    $contrasena='';
    
    $conexion = mysqli_connect($servidor,$usuario,$contrasena,$basedatos);

    if(!$conexion)
    {
        die('Error de conexion'.mysqli_error());
    }

?>