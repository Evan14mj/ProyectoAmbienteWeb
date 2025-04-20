<?php
require_once('functions/conexion.php');
require_once('functions/auth.php');
require_once('functions/user_roles.php');
require_once('includes/header.php');
require_once('includes/navbar.php');

// Verificar si el usuario es administrador
requiereRol('admin');

$error = '';
$success = '';
$usuario = null;

// Verificar si se proporcionó un ID de usuario
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = "ID de usuario no proporcionado";
    header('Location: gestion_usuarios.php');
    exit;
}

$usuario_id = (int)$_GET['id'];

// Obtener información del usuario
$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE USUARIOS_ID = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    $_SESSION['error'] = "El usuario no existe";
    header('Location: gestion_usuarios.php');
    exit;
}

$usuario = $resultado->fetch_assoc();

// Procesar el formulario de actualización
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $email = $_POST['email'] ?? '';
    $rol = $_POST['rol'] ?? '';
    
    // Validar campos
    if (empty($nombre) || empty($apellido) || empty($email) || empty($rol)) {
        $error = "Todos los campos son obligatorios";
    } else {
        // Verificar si el email ya existe para otro usuario
        $check_stmt = $conexion->prepare("SELECT USUARIOS_ID FROM usuarios WHERE EMAIL = ? AND USUARIOS_ID != ?");
        $check_stmt->bind_param("si", $email, $usuario_id);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
        
        if ($check_result->num_rows > 0) {
            $error = "El email ya está registrado para otro usuario";
        } else {
            // Actualizar la información del usuario
            $update_stmt = $conexion->prepare("UPDATE usuarios SET NOMBRE = ?, APELLIDO = ?, EMAIL = ?, ROL = ? WHERE USUARIOS_ID = ?");
            $update_stmt->bind_param("ssssi", $nombre, $apellido, $email, $rol, $usuario_id);
            
            if ($update_stmt->execute()) {
                $success = "Usuario actualizado correctamente";
                // Actualizar los datos del usuario para mostrarlos en el formulario
                $usuario['NOMBRE'] = $nombre;
                $usuario['APELLIDO'] = $apellido;
                $usuario['EMAIL'] = $email;
                $usuario['ROL'] = $rol;
                
                // Si se está editando el usuario actual, actualizar la sesión
                if ($usuario_id === (int)$_SESSION['usuario']['USUARIOS_ID']) {
                    $_SESSION['usuario']['NOMBRE'] = $nombre;
                    $_SESSION['usuario']['APELLIDO'] = $apellido;
                    $_SESSION['usuario']['EMAIL'] = $email;
                    $_SESSION['usuario']['ROL'] = $rol;
                }
            } else {
                $error = "Error al actualizar el usuario: " . $conexion->error;
            }
        }
    }
}
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Editar Usuario</h4>
                </div>
                <div class="card-body">
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    
                    <?php if ($success): ?>
                        <div class="alert alert-success"><?php echo $success; ?></div>
                    <?php endif; ?>
                    
                    <form method="POST">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario['NOMBRE']); ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo htmlspecialchars($usuario['APELLIDO']); ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($usuario['EMAIL']); ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol</label>
                            <select class="form-select" id="rol" name="rol" required>
                                <option value="usuario" <?php echo $usuario['ROL'] === 'usuario' ? 'selected' : ''; ?>>Usuario</option>
                                <option value="admin" <?php echo $usuario['ROL'] === 'admin' ? 'selected' : ''; ?>>Administrador</option>
                                <option value="moderador" <?php echo $usuario['ROL'] === 'moderador' ? 'selected' : ''; ?>>Moderador</option>
                            </select>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="gestion_usuarios.php" class="btn btn-secondary">Volver</a>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('includes/footer.php'); ?> 