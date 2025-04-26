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
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4><i class="fas fa-tachometer-alt"></i> Panel de Administración</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-success">
                        <i class="fas fa-user-shield fa-lg me-2"></i> Bienvenido al panel de administración, <strong><?php echo $_SESSION['usuario']['NOMBRE']; ?></strong>.
                        <p class="mb-0 mt-2">Desde aquí puedes gestionar todos los aspectos del sistema.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Sección de gestión de usuarios -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5><i class="fas fa-users"></i> Gestión de Usuarios</h5>
                </div>
                <div class="card-body">
                    <p>Administra los usuarios registrados en la plataforma.</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check me-2"></i> Ver todos los usuarios</li>
                        <li><i class="fas fa-check me-2"></i> Modificar información de usuarios</li>
                        <li><i class="fas fa-check me-2"></i> Gestionar permisos y roles</li>
                    </ul>
                </div>
                <div class="card-footer bg-white">
                    <a href="gestion_usuarios.php" class="btn btn-info btn-block w-100 text-white">
                        <i class="fas fa-user-cog"></i> Gestionar Usuarios
                    </a>
                </div>
            </div>
        </div>

        <!-- Sección de gestión de solicitudes -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-warning">
                    <h5><i class="fas fa-clipboard-list"></i> Gestión de Solicitudes</h5>
                </div>
                <div class="card-body">
                    <p>Revisa y administra las solicitudes de inscripción pendientes.</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check me-2"></i> Aprobar inscripciones</li>
                        <li><i class="fas fa-check me-2"></i> Rechazar solicitudes</li>
                        <li><i class="fas fa-check me-2"></i> Ver histórico de solicitudes</li>
                    </ul>
                </div>
                <div class="card-footer bg-white">
                    <a href="gestionSolicitudes.php" class="btn btn-warning btn-block w-100">
                        <i class="fas fa-tasks"></i> Ver Solicitudes
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Sección de gestión de eventos -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5><i class="fas fa-calendar-alt"></i> Gestión de Eventos</h5>
                </div>
                <div class="card-body">
                    <p>Crea y administra los eventos en el sistema.</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check me-2"></i> Crear nuevos eventos</li>
                        <li><i class="fas fa-check me-2"></i> Editar eventos existentes</li>
                        <li><i class="fas fa-check me-2"></i> Eliminar eventos</li>
                    </ul>
                </div>
                <div class="card-footer bg-white">
                    <div class="d-grid">
                        <a href="crear_evento.php" class="btn btn-success mb-2">
                            <i class="fas fa-plus-circle"></i> Crear Nuevo Evento
                        </a>
                        <div class="btn-group mt-2">
                            <a href="ver_eventos.php" class="btn btn-outline-success">
                                <i class="fas fa-list"></i> Lista
                            </a>
                            <a href="calendario_eventos.php" class="btn btn-outline-success">
                                <i class="fas fa-calendar-alt"></i> Calendario
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <!-- Accesos rápidos -->
        <div class="col-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5><i class="fas fa-bolt"></i> Accesos Rápidos</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="ver_eventos.php" class="btn btn-outline-primary btn-lg w-100">
                                <i class="fas fa-list fa-2x mb-2"></i><br>
                                Lista de Eventos
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="calendario_eventos.php" class="btn btn-outline-primary btn-lg w-100">
                                <i class="fas fa-calendar-alt fa-2x mb-2"></i><br>
                                Calendario
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="foro.php" class="btn btn-outline-info btn-lg w-100">
                                <i class="fas fa-comments fa-2x mb-2"></i><br>
                                Foro
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="index.php" class="btn btn-outline-secondary btn-lg w-100">
                                <i class="fas fa-home fa-2x mb-2"></i><br>
                                Página Principal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Asegúrate de incluir Font Awesome para los iconos -->
<script>
    // Verificar si Font Awesome ya está incluido
    if (document.querySelectorAll('link[href*="font-awesome"], link[href*="fontawesome"]').length === 0) {
        var fontAwesome = document.createElement('link');
        fontAwesome.rel = 'stylesheet';
        fontAwesome.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css';
        document.head.appendChild(fontAwesome);
    }
</script>

<?php require_once('includes/footer.php'); ?> 