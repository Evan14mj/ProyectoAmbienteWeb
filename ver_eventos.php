<?php
require_once('functions/conexion.php');
require_once('functions/user_roles.php');
require_once('includes/header.php');
require_once('includes/navbar.php');
?>

<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-light">
                <div class="card-body">
                    <h2 class="text-center">Eventos Disponibles</h2>
                    <p class="text-center text-muted">Aquí puedes ver todos los eventos disponibles para inscripción</p>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_GET['mensaje'])) {
        echo '<div class="alert alert-success text-center">' . htmlspecialchars($_GET['mensaje']) . '</div>';
    }
    ?>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="btn-group">
                <a href="ver_eventos.php" class="btn btn-primary active">
                    <i class="fas fa-list"></i> Vista de Lista
                </a>
                <a href="calendario_eventos.php" class="btn btn-outline-primary">
                    <i class="fas fa-calendar-alt"></i> Vista de Calendario
                </a>
            </div>
        </div>
        <div class="col-md-6 text-end">
            <?php if (isset($_SESSION['usuario']) && tieneRol('admin')): ?>
                <a href="crear_evento.php" class="btn btn-success">
                    <i class="fas fa-plus-circle"></i> Crear Nuevo Evento
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <?php
        $query = "SELECT EVENTO_ID, NOMBRE, FECHA, UBICACION, TIPO_ACTIVIDAD, DESCRIPCION 
                  FROM eventos
                  ORDER BY FECHA ASC";
        $result = $conexion->query($query);

        if ($result && $result->num_rows > 0) {
            while ($evento = $result->fetch_assoc()) {
        ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0"><?php echo htmlspecialchars($evento['NOMBRE']); ?></h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-3 text-muted">
                                <i class="far fa-calendar-alt"></i> Fecha: <?php echo date('d/m/Y', strtotime($evento['FECHA'])); ?>
                            </h6>
                            <p class="card-text">
                                <strong><i class="fas fa-map-marker-alt"></i> Ubicación:</strong> <?php echo htmlspecialchars($evento['UBICACION']); ?><br>
                                <strong><i class="fas fa-tag"></i> Tipo:</strong> <?php echo htmlspecialchars($evento['TIPO_ACTIVIDAD']); ?>
                            </p>
                            <p class="card-text"><?php echo nl2br(htmlspecialchars(substr($evento['DESCRIPCION'], 0, 100))); ?>
                                <?php if(strlen($evento['DESCRIPCION']) > 100): ?>...<?php endif; ?>
                            </p>
                        </div>
                        <div class="card-footer bg-white">
                            <div class="d-flex justify-content-between">
                                <a href="detalle_evento.php?id=<?php echo $evento['EVENTO_ID']; ?>" class="btn btn-primary btn-sm">
                                    <i class="fas fa-info-circle"></i> Ver Detalles
                                </a>
                                
                                <?php if (isset($_SESSION['usuario'])): ?>
                                    <?php if (tieneRol('admin')): ?>
                                        <div>
                                            <a href="editar_evento.php?id=<?php echo $evento['EVENTO_ID']; ?>" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <a href="functions/eliminar_evento.php?id=<?php echo $evento['EVENTO_ID']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este evento?');">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </a>
                                        </div>
                                    <?php else: ?>
                                        <a href="inscripcion.php?evento_id=<?php echo $evento['EVENTO_ID']; ?>" class="btn btn-success btn-sm">
                                            <i class="fas fa-user-plus"></i> Inscribirse
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo '<div class="col-12"><div class="alert alert-info text-center">No hay eventos disponibles. Si eres administrador, puedes crear nuevos eventos utilizando el botón superior.</div></div>';
        }
        ?>
    </div>

    <?php if (!isset($_SESSION['usuario'])): ?>
        <div class="row mt-4">
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle fa-lg me-2"></i> Para inscribirte en los eventos, por favor <a href="functions/login.php" class="alert-link">inicia sesión</a> o <a href="functions/register.php" class="alert-link">regístrate</a>.
                </div>
            </div>
        </div>
    <?php endif; ?>
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