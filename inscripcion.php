<?php 
    require_once('functions/conexion.php');
    require_once('functions/user_roles.php');
    
    // Verificar si el usuario está autenticado
    if (!isset($_SESSION['usuario'])) {
        header('Location: functions/login.php');
        exit;
    }
    
    // Procesar nueva solicitud de inscripción
    if (isset($_GET['evento_id'])) {
        $evento_id = $_GET['evento_id'];
        $usuario_id = $_SESSION['usuario']['USUARIOS_ID'];
        
        // Verificar si ya existe una inscripción para este usuario y ESTE evento específico
        $check_query = "SELECT * FROM inscripciones WHERE USUARIO_ID = ? AND EVENTO_ID = ?";
        $check_stmt = $conexion->prepare($check_query);
        $check_stmt->bind_param("ii", $usuario_id, $evento_id);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
        
        if ($check_result->num_rows > 0) {
            $mensaje = "Ya estás inscrito en este evento específico.";
        } else {
            // Insertar nueva inscripción con estado 'pendiente'
            $insert_query = "INSERT INTO inscripciones (USUARIO_ID, EVENTO_ID, ESTADO, FECHA) 
                            VALUES (?, ?, 'pendiente', NOW())";
            $insert_stmt = $conexion->prepare($insert_query);
            $insert_stmt->bind_param("ii", $usuario_id, $evento_id);
            
            if ($insert_stmt->execute()) {
                $mensaje = "Solicitud de inscripción enviada correctamente. Un administrador revisará tu solicitud.";
            } else {
                $mensaje = "Error al enviar la solicitud: " . $conexion->error;
            }
        }
    }
    
    require_once('includes/header.php');
    require_once('includes/navbar.php'); 
?> 
    
<main class="container mt-4">
    <section class="inscripciones">
        <h2 class="text-center mb-4">MIS INSCRIPCIONES</h2>
        
        <?php if (isset($mensaje)): ?>
            <div class="alert alert-info text-center"><?php echo $mensaje; ?></div>
        <?php endif; ?>
        
        <?php
        // Obtener inscripciones del usuario actual
        $query = "SELECT i.INSCRIPCION_ID, i.ESTADO, i.FECHA, e.EVENTO_ID, e.NOMBRE, e.FECHA as FECHA_EVENTO, e.UBICACION, e.TIPO_ACTIVIDAD 
                  FROM inscripciones i
                  JOIN eventos e ON i.EVENTO_ID = e.EVENTO_ID
                  WHERE i.USUARIO_ID = ?
                  ORDER BY e.FECHA ASC";
        $stmt = $conexion->prepare($query);
        $usuario_id = $_SESSION['usuario']['USUARIOS_ID'];
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            while ($inscripcion = $result->fetch_assoc()) {
        ?>
            <div class="card mb-3">
                <div class="card-header <?php echo ($inscripcion['ESTADO'] == 'aprobada') ? 'bg-success text-white' : (($inscripcion['ESTADO'] == 'rechazada') ? 'bg-danger text-white' : 'bg-warning'); ?>">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0"><?php echo htmlspecialchars($inscripcion['NOMBRE']); ?></h3>
                        <span class="badge <?php echo ($inscripcion['ESTADO'] == 'aprobada') ? 'bg-light text-success' : (($inscripcion['ESTADO'] == 'rechazada') ? 'bg-light text-danger' : 'bg-light text-warning'); ?>">
                            Estado: <?php echo ucfirst(htmlspecialchars($inscripcion['ESTADO'])); ?>
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <p><strong>Fecha del evento:</strong> <?php echo date('d/m/Y', strtotime($inscripcion['FECHA_EVENTO'])); ?></p>
                    <p><strong>Ubicación:</strong> <?php echo htmlspecialchars($inscripcion['UBICACION']); ?></p>
                    <p><strong>Tipo de actividad:</strong> <?php echo htmlspecialchars($inscripcion['TIPO_ACTIVIDAD']); ?></p>
                    <p><strong>Fecha de inscripción:</strong> <?php echo date('d/m/Y H:i', strtotime($inscripcion['FECHA'])); ?></p>
                    <a href="detalle_evento.php?id=<?php echo $inscripcion['EVENTO_ID']; ?>" class="btn btn-primary">
                        Ver Detalles del Evento
                    </a>
                </div>
            </div>
        <?php
            }
        } else {
            echo '<div class="alert alert-info">No tienes inscripciones a eventos.</div>';
        }
        ?>
        
        <div class="text-center mt-4 mb-4">
            <a href="ver_eventos.php" class="btn btn-success">Ver todos los eventos</a>
        </div>
    </section>
</main>

<?php require_once('includes/footer.php'); ?>