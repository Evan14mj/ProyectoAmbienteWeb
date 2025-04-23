<?php 
    require_once('functions/conexion.php');
    session_start();
    require_once('includes/header.php');
    require_once('includes/navbar.php'); 
    ?> 

<div class="container mt-4">
    <h2 class="text-center">Foro</h2>
    <div class="row">
        <?php
        $query = "SELECT f.TITULO, f.DESCRIPCION, f.LINK, f.FECHA_PUBLICACION, u.NOMBRE 
                  FROM foro f
                  JOIN usuarios u ON f.USUARIO_ID = u.USUARIOS_ID
                  ORDER BY f.FECHA_PUBLICACION DESC";
        $result = $conexion->query($query);

            ?>