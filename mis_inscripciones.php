<?php
require_once('functions/conexion.php');
session_start();
require_once('includes/header.php');
require_once('includes/navbar.php');

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    echo '<div class="alert alert-danger text-center mt-4">Debes iniciar sesión para ver tus inscripciones.</div>';
    require_once('includes/footer.php');
    exit;
}

$usuario_id = $_SESSION['usuario']['USUARIOS_ID'];

// Consulta para obtener las inscripciones del usuario junto con el EVENTO_ID
$query = "
    SELECT 
        e.EVENTO_ID,
        e.NOMBRE, 
        e.FECHA, 
        e.UBICACION, 
        e.TIPO_ACTIVIDAD, 
        e.DESCRIPCION 
    FROM inscripciones i
    JOIN eventos e ON i.EVENTO_ID = e.EVENTO_ID
    WHERE i.USUARIO_ID = ?
    ORDER BY e.FECHA DESC
";

$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Mis Inscripciones</h2>
    <div class="row">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($evento = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($evento['NOMBRE']); ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                Fecha: <?php echo date('d/m/Y', strtotime($evento['FECHA'])); ?>
                            </h6>
                            <p class="card-text">
                                <strong>Ubicación:</strong> <?php echo htmlspecialchars($evento['UBICACION']); ?><br>
                                <strong>Tipo:</strong> <?php echo htmlspecialchars($evento['TIPO_ACTIVIDAD']); ?>
                            </p>
                            <p class="card-text"><?php echo nl2br(htmlspecialchars($evento['DESCRIPCION'])); ?></p>
                            <!-- Botón para ver detalle del evento -->
                            <a href="detalle_evento.php?id=<?php echo $evento['EVENTO_ID']; ?>" class="btn btn-primary btn-sm">
                                Ver Detalles
                            </a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center">No estás inscrito en ningún evento actualmente.</p>
        <?php endif; ?>
    </div>

    <!-- Botón para inscribirse a un nuevo evento -->
    <div class="d-flex justify-content-center mt-4 mb-4">
        <a href="inscribirse_evento.php" class="btn btn-success">Inscribirse a un nuevo evento</a>
    </div>
</div>

<?php
$stmt->close();
$conexion->close();
require_once('includes/footer.php');
?>
