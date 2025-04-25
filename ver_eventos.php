<?php 
require_once('functions/conexion.php');
session_start();
require_once('includes/header.php');
require_once('includes/navbar.php');
?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Eventos Disponibles</h2>
    <div class="row">
        <?php
        $query = "SELECT EVENTO_ID, NOMBRE, FECHA, UBICACION, TIPO_ACTIVIDAD, DESCRIPCION 
                  FROM eventos
                  ORDER BY FECHA DESC";
        $result = $conexion->query($query);

        if ($result && $result->num_rows > 0) {
            while ($evento = $result->fetch_assoc()) {
        ?>
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
                    <a href="detalle_evento.php?id=<?php echo $evento['EVENTO_ID']; ?>" class="btn btn-primary">
                        Ver Detalles
                    </a>
                </div>
            </div>
        </div>
        <?php 
            }
        } else {
            echo "<p class='text-center'>No hay eventos disponibles.</p>";
        }
        ?>
    </div>

    <div class="d-flex justify-content-center mt-4 mb-4">
        <a href="crear_evento.php" class="btn btn-success">Crear Evento</a>
    </div>
</div>

<?php require_once('includes/footer.php'); ?>
