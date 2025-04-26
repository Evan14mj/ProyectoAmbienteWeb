<?php
require_once('conexion.php');
require_once('user_roles.php');

session_start();

// Verificar si el usuario está autenticado y es administrador
if (!isset($_SESSION['usuario']) || !tieneRol('admin')) {
    header('Location: ../index.php');
    exit;
}

if (isset($_GET['id'])) {
    $evento_id = $_GET['id'];

    $stmt = $conexion->prepare("DELETE FROM eventos WHERE EVENTO_ID = ?");
    $stmt->bind_param("i", $evento_id);

    if ($stmt->execute()) {
        header("Location: ../ver_eventos.php?mensaje=Evento eliminado correctamente");
        exit();
    } else {
        echo "Error al eliminar el evento: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
}
?>
