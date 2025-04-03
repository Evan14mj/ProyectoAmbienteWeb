<?php
// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_PORT', '3307'); // Puerto modificado
define('DB_USER', 'root');
define('DB_PASS', '1234');
define('DB_NAME', 'proyecto_ambienteweb');

// Establecer conexión
try {
    $dsn = "mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME;
    $conexion = new PDO($dsn, DB_USER, DB_PASS);
    
    // Configurar atributos de PDO
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $conexion->exec("SET NAMES utf8");
    
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>