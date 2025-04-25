<?php
require_once('includes/header.php');
require_once('includes/navbar.php');
require_once('functions/conexion.php');
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
                <div class="form-group mb-3">
                    <label>ID del Organizador</label>
                    <input type="number" name="organizador_id" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">Crear Evento</button>
                
                <a href="ver_eventos.php" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<?php require_once('includes/footer.php'); ?>
