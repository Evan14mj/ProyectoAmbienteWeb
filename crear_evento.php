<?php
require_once('functions/conexion.php');
require_once('functions/user_roles.php');

// Redirigir si no es administrador
if (!isset($_SESSION['usuario']) || !tieneRol('admin')) {
    header('Location: index.php');
    exit;
}

require_once('includes/header.php');
require_once('includes/navbar.php');
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h4>Crear Evento</h4>
        </div>
        <div class="card-body">
            <form action="functions/evento.php" method="POST">
                <div class="form-group mb-3">
                    <label>Nombre del Evento</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label>Fecha</label>
                    <input type="date" name="fecha" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label>Ubicación</label>
                    <input type="text" name="ubicacion" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label>Tipo de Actividad</label>
                    <input type="text" name="tipo_actividad" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label>Descripción</label>
                    <textarea name="descripcion" class="form-control" required></textarea>
                </div>
                
                <!-- Usar el ID del usuario actual como organizador -->
                <input type="hidden" name="organizador_id" value="<?php echo $_SESSION['usuario']['USUARIOS_ID']; ?>">

                <button type="submit" class="btn btn-success">Crear Evento</button>
                
                <a href="ver_eventos.php" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<?php require_once('includes/footer.php'); ?>
