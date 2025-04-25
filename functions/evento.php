<?php
require_once('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $ubicacion = $_POST['ubicacion'];
    $tipo = $_POST['tipo_actividad'];
    $descripcion = $_POST['descripcion'];
    $organizador_id = $_POST['organizador_id'];

    $sql = "INSERT INTO eventos (NOMBRE, FECHA, UBICACION, TIPO_ACTIVIDAD, DESCRIPCION, ORGANIZADOR_ID) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssssi", $nombre, $fecha, $ubicacion, $tipo, $descripcion, $organizador_id);

    if ($stmt->execute()) {
        header("Location: ../ver_eventos.php?mensaje=Evento creado correctamente");
        exit(); 
    } else {
        echo "Error al crear el evento: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
}
?>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Crear un Evento</h4>
                </div>
                <div class="card-body">
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>

                    <?php if ($succes): ?>
                        <div class="alert alert-success"><?php echo $succes; ?></div>
                    <?php endif; ?>

                    <form method="POST" action="evento.php">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Evento</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                        </div>
                        <div class="mb-3">
                            <label for="ubicacion" class="form-label">Ubicación</label>
                            <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
                        </div>
                        <div class="mb-3">
                            <label for="tipo_actividad" class="form-label">Tipo de Actividad</label>
                            <input type="text" class="form-control" id="tipo_actividad" name="tipo_actividad" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="organizador_id" class="form-label">ID del Organizador</label>
                            <input type="number" class="form-control" id="organizador_id" name="organizador_id" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">Crear Evento</button>
                            <a href="../eventos.php" class="btn btn-secondary">Ver Eventos</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once ('../includes/footer.php'); ?>
