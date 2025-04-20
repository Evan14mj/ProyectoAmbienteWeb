<?php
require_once('functions/conexion.php');
require_once('functions/auth.php');
require_once('functions/user_roles.php');

// Verificar si el usuario es administrador
requiereRol('admin');

// Verificar si se proporcionó un ID de usuario
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = "ID de usuario no proporcionado";
    header('Location: gestion_usuarios.php');
    exit;
}

$usuario_id = (int)$_GET['id'];

// No permitir que un administrador se elimine a sí mismo
if ($usuario_id === (int)$_SESSION['usuario']['USUARIOS_ID']) {
    $_SESSION['error'] = "No puedes eliminar tu propio usuario";
    header('Location: gestion_usuarios.php');
    exit;
}

// Verificar si el usuario existe
$stmt = $conexion->prepare("SELECT ROL FROM usuarios WHERE USUARIOS_ID = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    $_SESSION['error'] = "El usuario no existe";
    header('Location: gestion_usuarios.php');
    exit;
}

// Eliminar el usuario
$stmt = $conexion->prepare("DELETE FROM usuarios WHERE USUARIOS_ID = ?");
$stmt->bind_param("i", $usuario_id);

if ($stmt->execute()) {
    $_SESSION['success'] = "Usuario eliminado correctamente";
} else {
    $_SESSION['error'] = "Error al eliminar el usuario: " . $conexion->error;
}

// Redirigir de vuelta a la página de gestión de usuarios
header('Location: gestion_usuarios.php');
exit; 