<?php
require_once('functions/conexion.php');
require_once('functions/auth.php');
require_once('functions/user_roles.php');
require_once('includes/header.php');
require_once('includes/navbar.php');

// Verificar si el usuario es administrador
requiereRol('admin');
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4>Panel de Administración</h4>
                </div>
                <div class="card-body">
                    <p>Bienvenido al panel de administración, <?php echo $_SESSION['usuario']['NOMBRE']; ?>.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Sección de gestión de usuarios -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5>Gestión de Usuarios</h5>
                </div>
                <div class="card-body">
                    <p>Administra los usuarios del sistema.</p>
                    <a href="gestion_usuarios.php" class="btn btn-info">Gestionar Usuarios</a>
                </div>
            </div>
        </div>

        <!-- Sección de gestión de solicitudes -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-warning">
                    <h5>Gestión de Solicitudes</h5>
                </div>
                <div class="card-body">
                    <p>Administra las solicitudes pendientes.</p>
                    <a href="gestionSolicitudes.php" class="btn btn-warning">Ver Solicitudes</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('includes/footer.php'); ?> 