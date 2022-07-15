<?php 
    /*RESTAURAMOS LA SESION*/
    session_start();
    /*DESTRUIMOS LA SESION*/
    session_destroy();
    header("Location:Index.php");

?>