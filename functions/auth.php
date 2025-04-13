<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['usuario']);
}

function login($email, $password) {
    global $conexion;
    
    $sql = "SELECT USUARIO_ID, NOMBRE, APELLIDO, EMAIL, PASSWORD, ROL, FECHA_REGISTRO 
            FROM usuarios 
            WHERE EMAIL = ? AND PASSWORD = ?";
    
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows > 0) {
        $_SESSION['usuario'] = $resultado->fetch_assoc();
        return true;
    }
    return false;
}

function register($nombre, $apellido, $email, $password) {
    global $conexion;
    
    // Verificar si el email ya existe
    $check_sql = "SELECT EMAIL FROM usuarios WHERE EMAIL = ?";
    $check_stmt = $conexion->prepare($check_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    
    if ($result->num_rows > 0) {
        return "El correo electrónico ya está registrado";
    }
    
    // Insertar nuevo usuario - asegurándonos de que coincida con la estructura exacta de la tabla
    $sql = "INSERT INTO usuarios (NOMBRE, APELLIDO, EMAIL, PASSWORD, ROL, FECHA_REGISTRO) 
            VALUES (?, ?, ?, ?, 'usuario', CURRENT_TIMESTAMP)";
    
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $apellido, $email, $password);
    
    if ($stmt->execute()) {
        // Si el registro es exitoso, obtener los datos del usuario para la sesión
        $usuario_id = $conexion->insert_id;
        $sql_select = "SELECT USUARIO_ID, NOMBRE, APELLIDO, EMAIL, PASSWORD, ROL, FECHA_REGISTRO 
                       FROM usuarios WHERE USUARIO_ID = ?";
        $stmt_select = $conexion->prepare($sql_select);
        $stmt_select->bind_param("i", $usuario_id);
        $stmt_select->execute();
        $resultado = $stmt_select->get_result();
        
        if ($resultado->num_rows > 0) {
            $_SESSION['usuario'] = $resultado->fetch_assoc();
            return true;
        }
    }
    
    return "Error al registrar el usuario: " . $conexion->error;
}

function logout() {
    session_unset();
    session_destroy();
}
?> 