<?php 
    require_once('functions/conexion.php');
    session_start();
    require_once('includes/header.php');
    require_once('includes/navbar.php'); 
    ?> 

<div class="container mt-4">
    <h2 class="text-center">Foro</h2>
    <div class="row">
        <?php
        $query = "SELECT f.TITULO, f.DESCRIPCION, f.LINK, f.FECHA_PUBLICACION, u.NOMBRE 
                  FROM foro f
                  JOIN usuarios u ON f.USUARIO_ID = u.USUARIOS_ID
                  ORDER BY f.FECHA_PUBLICACION DESC";
        $result = $conexion->query($query);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

            ?>
         <div class="col-md-4 mb-4 d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo ($row['TITULO']); ?></h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">Por: <?php echo ($row['NOMBRE']); ?></h6>
                    <p class="card-text"><?php echo ($row['DESCRIPCION']); ?></p>
                    <a href="<?php echo ($row['LINK']); ?>" class="card-link" target="_blank">Ir al tema</a>
                    <span class="card-link text-muted"><?php echo date('d/m/Y', strtotime($row['FECHA_PUBLICACION'])); ?></span>
                </div>
            </div>
        </div>
        <?php 
            }
        } else {
            echo "<p class='text-center'>No hay publicaciones disponibles en el foro.</p>";
        }
        ?>
    </div>
</div>

<div class="d-flex justify-content-center mb-4">
        <a href="functions/Post.php">
            <button type="button" class="btn btn-success">Agregar Post</button>
        </a>
    </div>
    
    <?php require_once('includes/footer.php'); ?>