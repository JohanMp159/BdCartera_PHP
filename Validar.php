<?php
    $usuario = $_POST['nombre']; 
    $clave = $_POST['clave']; 

    $conexion=mysqli_connect("localhost","root","","cartera");

    $consulta="SELECT * FROM admins WHERE usuario='$usuario' and clave='$clave'";
    $permisos=mysqli_query($conexion,$consulta);
    
    $filas=mysqli_num_rows($permisos);
    if($filas > 0)
    {
        header("Location:IndexForm.php");
    } else { 
        $mensaje="Usuario o contraseña incorrectos."; 
        $url="Index.php";
    }
      echo "<script type='text/javascript'>
              alert('$mensaje');
              window.location='$url';
           </script>";

    
    //Creamos o Reaunumados una sesion: session_start(); 
    //Aquí esta siendo creada la sesion principalmente.
    session_start();

    /* Se crea una variable $_$SESSION['usuario'], */

    /*PERMITE UTILIZAR EN DIFERENTES ARCHIVOS LA VARIBALE USUARIO, 
    YA QUE ESTA SOLO SE ENCUENTRA DECLARADA EN UN ARCHIVO PRINCIPAL.
    Validar.php */
    $_SESSION['usuario'] = $usuario;

    //INDICAMOS QUE NOS DEVUELVA LOS VALORES ENCONTRADOS, EN $permisos
    mysqli_free_result($permisos);
    //INDICAMOS QUE CIERRE LA $conexion
    mysqli_close($conexion);

?>