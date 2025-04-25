<?php 
require_once('functions/conexion.php');
session_start();
require_once('includes/header.php');
require_once('includes/navbar.php');

if (isset($_GET['id'])) {
    $evento_id = $_GET['id'];

    $query = "SELECT EVENTO_ID, NOMBRE, FECHA, UBICACION, TIPO_ACTIVIDAD, DESCRIPCION 
              FROM eventos
              WHERE EVENTO_ID = ?";
    
    if ($stmt = $conexion->prepare($query)) {
        $stmt->bind_param("i", $evento_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $evento = $result->fetch_assoc();
        } else {
            echo "<p class='text-center'>Evento no encontrado.</p>";
            exit;
        }
    } else {
        echo "<p class='text-center'>Error al realizar la consulta.</p>";
        exit;
    }
} else {
    echo "<p class='text-center'>No se ha especificado un evento.</p>";
    exit;
}
?>

<div class="container mt-5">
    <h2 class="text-center"><?php echo htmlspecialchars($evento['NOMBRE']); ?></h2>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
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
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4 mb-4">
        <a href="ver_eventos.php" class="btn btn-secondary">Volver a la lista de eventos</a>
    </div>
</div>

<?php require_once('includes/footer.php'); ?>
