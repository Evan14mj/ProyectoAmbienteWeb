<?php
    $hostname="localhost:3307";
    $user="root";
    $password="";
    $database="proyecto_ambienteweb";

    $conexion = new mysqli($hostname, $user, $password, $database);
    if ($conexion->connect_error) {
        die("Conexon fallida: ".$conexion->connect_error);
    }
?>   