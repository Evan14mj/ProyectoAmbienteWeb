<?php
require_once('functions/conexion.php');
require_once('functions/auth.php');
require_once('functions/user_roles.php');
require_once('includes/header.php');
require_once('includes/navbar.php');

// Verificar que el usuario está logueado
if (!isLoggedIn()) {
    header('Location: functions/login.php');
    exit;
}

// Obtener información del usuario
$usuario = $_SESSION['usuario'];
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4>Mi Perfil</h4>
                </div>
                <div class="card-body">
                    <h5>Información Personal</h5>
                    <p>
                        <strong>Nombre:</strong> <?php echo $usuario['NOMBRE'] . ' ' . $usuario['APELLIDO']; ?><br>
                        <strong>Email:</strong> <?php echo $usuario['EMAIL']; ?><br>
                        <strong>Rol:</strong> <?php echo ucfirst($usuario['ROL']); ?><br>
                        <strong>Fecha de registro:</strong> <?php echo $usuario['FECHA_REGISTRO']; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Esta sección es visible para todos los usuarios -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5>Mis Inscripciones</h5>
                </div>
                <div class="card-body">
                    <p>Ver las actividades en las que estás inscrito.</p>
                    <a href="inscripcion.php" class="btn btn-info">Ver Inscripciones</a>
                </div>
            </div>
        </div>

        <!-- Sección visible solo para administradores -->
        <?php mostrarSiTieneRol('admin', '
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h5>Administración</h5>
                </div>
                <div class="card-body">
                    <p>Acceder al panel de administración.</p>
                    <a href="panel_admin.php" class="btn btn-danger">Panel de Administración</a>
                </div>
            </div>
        </div>
        '); ?>

        <!-- Sección visible solo para usuarios normales -->
        <?php mostrarSiTieneRol('usuario', '
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5>Eventos Disponibles</h5>
                </div>
                <div class="card-body">
                    <p>Ver eventos disponibles para inscripción.</p>
                    <a href="ver_eventos.php" class="btn btn-success">Ver Eventos</a>
                </div>
            </div>
        </div>
        '); ?>
    </div>
</div>

<?php require_once('includes/footer.php'); ?> 