<?php
require_once('functions/conexion.php');
session_start();
require_once('includes/header.php');
require_once('includes/navbar.php');

if (!isset($_GET['id'])) {
    header("Location: ver_eventos.php");
    exit;
}

$evento_id = $_GET['id'];
$query = "SELECT * FROM eventos WHERE EVENTO_ID = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $evento_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    echo "<div class='container mt-4'><div class='alert alert-danger'>Evento no encontrado.</div></div>";
    exit;
}

$evento = $result->fetch_assoc();
?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Editar Evento</h2>
    <form action="functions/actualizar_evento.php" method="POST">
        <input type="hidden" name="evento_id" value="<?php echo $evento['EVENTO_ID']; ?>">
        <div class="mb-3">
            <label>Nombre del Evento</label>
            <input type="text" name="nombre" class="form-control" value="<?php echo $evento['NOMBRE']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Fecha</label>
            <input type="date" name="fecha" class="form-control" value="<?php echo $evento['FECHA']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Ubicación</label>
            <input type="text" name="ubicacion" class="form-control" value="<?php echo $evento['UBICACION']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Tipo de Actividad</label>
            <input type="text" name="tipo_actividad" class="form-control" value="<?php echo $evento['TIPO_ACTIVIDAD']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control" required><?php echo $evento['DESCRIPCION']; ?></textarea>
        </div>
        <div class="mb-3">
            <label>ID del Organizador</label>
            <input type="number" name="organizador_id" class="form-control" value="<?php echo $evento['ORGANIZADOR_ID']; ?>" required>
        </div>
        <button type="submit" class="btn btn-warning">Actualizar Evento</button>
        <a href="ver_eventos.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php require_once('includes/footer.php'); ?>
