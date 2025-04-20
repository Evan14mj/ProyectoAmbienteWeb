<?php
// Asegurar que la sesión esté iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Verifica si el usuario tiene el rol especificado
 * @param string $rol El rol a verificar
 * @return boolean
 */
function tieneRol($rol) {
    if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario']['ROL'])) {
        return false;
    }
    
    return $_SESSION['usuario']['ROL'] === $rol;
}

/**
 * Muestra contenido HTML si el usuario tiene el rol especificado
 * @param string $rol El rol necesario
 * @param string $contenido El HTML a mostrar
 */
function mostrarSiTieneRol($rol, $contenido) {
    if (tieneRol($rol)) {
        echo $contenido;
    }
}

/**
 * Redirige al usuario si no tiene el rol especificado
 * @param string $rol El rol requerido
 * @param string $url URL de redirección
 */
function requiereRol($rol, $url = 'index.php') {
    if (!tieneRol($rol)) {
        header("Location: $url");
        exit;
    }
}
?> 