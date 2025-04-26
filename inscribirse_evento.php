<?php
require_once('functions/conexion.php');
session_start();
require_once('includes/header.php');
require_once('includes/navbar.php');

// Mensaje de éxito si se redirige después de una inscripción
if (isset($_GET['mensaje'])) {
    echo '<div class="alert alert-success text-center">' . htmlspecialchars($_GET['mensaje']) . '</div>';
}
?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Inscribirse a Eventos</h2>
    <div class="row">
        <?php
        $query = "SELECT EVENTO_ID, NOMBRE, FECHA, UBICACION, TIPO_ACTIVIDAD FROM eventos ORDER BY FECHA DESC";
        $result = $conexion->query($query);

        if ($result && $result->num_rows > 0) {
            while ($evento = $result->fetch_assoc()) {
        ?>
        <div class="col-md-4 mb-4 d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($evento['NOMBRE']); ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <?php echo date('d/m/Y', strtotime($evento['FECHA'])); ?> - <?php echo htmlspecialchars($evento['UBICACION']); ?>
                    </h6>
                    <p class="card-text"><strong>Tipo:</strong> <?php echo htmlspecialchars($evento['TIPO_ACTIVIDAD']); ?></p>
                    <form action="functions/inscribirse_evento.php" method="POST">
                        <input type="hidden" name="evento_id" value="<?php echo $evento['EVENTO_ID']; ?>">
                        <button type="submit" class="btn btn-success btn-sm w-100">Inscribirse</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
            }
        } else {
            echo "<p class='text-center'>No hay eventos disponibles para inscribirse.</p>";
        }
        ?>
    </div>
</div>

<?php require_once('includes/footer.php'); ?>
