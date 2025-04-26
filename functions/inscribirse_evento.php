<?php
require_once('conexion.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['evento_id'])) {
    if (!isset($_SESSION['usuario'])) {
        header("Location: ../login.php");
        exit();
    }

    $evento_id = $_POST['evento_id'];
    $usuario_id = $_SESSION['usuario']['USUARIOS_ID'];
    $fecha = date('Y-m-d');
    $estado = 'ACTIVO';

    $stmt = $conexion->prepare("INSERT INTO inscripciones (USUARIO_ID, EVENTO_ID, FECHA, ESTADO) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $usuario_id, $evento_id, $fecha, $estado);

    if ($stmt->execute()) {
        header("Location: ../inscribirse_evento.php?mensaje=Inscripción exitosa");
    } else {
        header("Location: ../inscribirse_evento.php?mensaje=Error al inscribirse");
    }

    $stmt->close();
    $conexion->close();
}
?>
