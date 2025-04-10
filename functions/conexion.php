<?php
    $hostname="localhost:3307";
    $user="Evan";
    $password="1234";
    $database="proyecto_ambienteweb";

    $conexion = new mysqli($hostname, $user, $password, $database);
    if ($conexion->connect_error) {
        die("Conexon fallida: ".$conexion->connect_error);
    }
?>   