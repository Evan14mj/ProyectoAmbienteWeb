<?php 
    require_once('functions/conexion.php');
    session_start();
    require_once('includes/header.php');
    require_once('includes/navbar.php'); 
?> 

<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-light">
                <div class="card-body">
                    <h2 class="text-center">Foro de la Comunidad</h2>
                    <p class="text-center text-muted">Encuentra recursos, consejos y discusiones sobre actividades físicas y deportes</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <?php
        // Consulta actualizada para coincidir con la estructura real de la tabla
        $query = "SELECT PUBLICACION_ID, USUARIO_ID, CONTENIDO, FECHA_PUBLICACION, TIPO, 
                         usuarios.NOMBRE 
                  FROM foro 
                  LEFT JOIN usuarios ON foro.USUARIO_ID = usuarios.USUARIOS_ID
                  ORDER BY FECHA_PUBLICACION DESC";
        
        $result = $conexion->query($query);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Determinar el tipo de contenido para mostrar un icono adecuado
                $icon = "fas fa-link";
                if ($row['TIPO'] == 'video') {
                    $icon = "fas fa-video";
                } elseif ($row['TIPO'] == 'imagen') {
                    $icon = "fas fa-image";
                } elseif ($row['TIPO'] == 'articulo') {
                    $icon = "fas fa-newspaper";
                }
        ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">
                            <i class="<?php echo $icon; ?>"></i> <?php echo htmlspecialchars($row['TIPO']); ?>
                        </h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">
                            <i class="fas fa-user"></i> Por: <?php echo $row['NOMBRE'] ? htmlspecialchars($row['NOMBRE']) : 'Usuario anónimo'; ?>
                        </h6>
                        <p class="card-text"><?php echo htmlspecialchars($row['CONTENIDO']); ?></p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-secondary"><?php echo htmlspecialchars($row['TIPO']); ?></span>
                            <small class="text-muted">
                                <i class="far fa-calendar-alt"></i> <?php echo date('d/m/Y', strtotime($row['FECHA_PUBLICACION'])); ?>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        <?php 
            }
        } else {
            echo '<div class="alert alert-info text-center">No hay publicaciones disponibles en el foro. ¡Sé el primero en compartir algo!</div>';
        }
        ?>
    </div>
    
    <div class="d-flex justify-content-center mt-4 mb-4">
        <a href="functions/Post.php" class="btn btn-success btn-lg">
            <i class="fas fa-plus-circle"></i> Agregar Nueva Publicación
        </a>
    </div>
</div>

<!-- Asegúrate de incluir Font Awesome para los iconos -->
<script>
    // Verificar si Font Awesome ya está incluido
    if (document.querySelectorAll('link[href*="font-awesome"], link[href*="fontawesome"]').length === 0) {
        var fontAwesome = document.createElement('link');
        fontAwesome.rel = 'stylesheet';
        fontAwesome.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css';
        document.head.appendChild(fontAwesome);
    }
</script>
    
<?php require_once('includes/footer.php'); ?>