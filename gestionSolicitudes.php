<?php
    require_once('functions/conexion.php');
    require_once('functions/user_roles.php');
    
    // Redirigir si no es administrador
    if (!isset($_SESSION['usuario']) || !tieneRol('admin')) {
        header('Location: index.php');
        exit;
    }
    
    // Procesar cambios de estado (si se enviaron)
    if (isset($_POST['inscripcion_id']) && isset($_POST['nuevo_estado'])) {
        $inscripcion_id = $_POST['inscripcion_id'];
        $nuevo_estado = $_POST['nuevo_estado'];
        
        $update_query = "UPDATE inscripciones SET ESTADO = ? WHERE INSCRIPCION_ID = ?";
        $update_stmt = $conexion->prepare($update_query);
        $update_stmt->bind_param("si", $nuevo_estado, $inscripcion_id);
        
        if ($update_stmt->execute()) {
            $mensaje = "Estado de la solicitud actualizado correctamente.";
        } else {
            $error = "Error al actualizar el estado: " . $conexion->error;
        }
    }
    
    require_once('includes/header.php');
    require_once('includes/navbar.php');
?>
    
    <main class="container mt-4">
        <section class="gest-solicitudes">
            <h2 class="text-center mb-4">SOLICITUDES DE INSCRIPCIÓN</h2>
            
            <?php if (isset($mensaje)): ?>
                <div class="alert alert-success"><?php echo $mensaje; ?></div>
            <?php endif; ?>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php
            // Obtener todas las solicitudes de inscripción
            $query = "SELECT i.INSCRIPCION_ID, i.ESTADO, i.FECHA, 
                             e.NOMBRE as EVENTO_NOMBRE, e.TIPO_ACTIVIDAD, 
                             u.NOMBRE, u.APELLIDO, u.EMAIL
                      FROM inscripciones i
                      JOIN eventos e ON i.EVENTO_ID = e.EVENTO_ID
                      JOIN usuarios u ON i.USUARIO_ID = u.USUARIOS_ID
                      ORDER BY i.FECHA DESC";
            $result = $conexion->query($query);
            
            if ($result && $result->num_rows > 0) {
                echo '<div class="row">';
                while ($solicitud = $result->fetch_assoc()) {
            ?>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header <?php echo ($solicitud['ESTADO'] == 'aprobada') ? 'bg-success text-white' : (($solicitud['ESTADO'] == 'rechazada') ? 'bg-danger text-white' : 'bg-warning'); ?>">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Solicitud #<?php echo $solicitud['INSCRIPCION_ID']; ?></h5>
                                <span class="badge bg-light text-dark">
                                    Estado: <?php echo ucfirst($solicitud['ESTADO']); ?>
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <p><strong>Usuario:</strong> <?php echo htmlspecialchars($solicitud['NOMBRE'] . ' ' . $solicitud['APELLIDO']); ?></p>
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($solicitud['EMAIL']); ?></p>
                            <p><strong>Evento:</strong> <?php echo htmlspecialchars($solicitud['EVENTO_NOMBRE']); ?></p>
                            <p><strong>Tipo de actividad:</strong> <?php echo htmlspecialchars($solicitud['TIPO_ACTIVIDAD']); ?></p>
                            <p><strong>Fecha de solicitud:</strong> <?php echo date('d/m/Y H:i', strtotime($solicitud['FECHA'])); ?></p>
                            
                            <form method="POST" class="mt-3">
                                <input type="hidden" name="inscripcion_id" value="<?php echo $solicitud['INSCRIPCION_ID']; ?>">
                                <div class="d-flex gap-2">
                                    <select name="nuevo_estado" class="form-select">
                                        <option value="pendiente" <?php echo ($solicitud['ESTADO'] == 'pendiente') ? 'selected' : ''; ?>>Pendiente</option>
                                        <option value="aprobada" <?php echo ($solicitud['ESTADO'] == 'aprobada') ? 'selected' : ''; ?>>Aprobada</option>
                                        <option value="rechazada" <?php echo ($solicitud['ESTADO'] == 'rechazada') ? 'selected' : ''; ?>>Rechazada</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php
                }
                echo '</div>';
            } else {
                echo '<div class="alert alert-info text-center">No hay solicitudes de inscripción pendientes.</div>';
            }
            ?>
        </section>
    </main>

<?php require_once('includes/footer.php'); ?>

