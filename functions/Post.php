<?php 
    
    require_once('conexion.php');
    
    require_once('../includes/header.php');
    require_once('../includes/navbar.php');

    $error = ""; 
    $succes = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (!isset($_SESSION['usuario'])){
            $error = 'Debes de iniciar sesion para poder publicar';
        } else {
            $usuario_id = $_SESSION['usuario']['USUARIOS_ID'];
            $titulo = $_POST['Titulo'] ?? '';
            $descripcion = $_POST['Descripcion'] ?? '';
            $link = $_POST['Link'] ?? '';
            $fecha = date ('Y-m-d');

            if(empty($titulo) || empty($descripcion) || empty($link)){
                $error = 'Porfavor llenar todos los espacios';
            } else {
            $stmt = $conexion->prepare ("INSERT INTO foro (USUARIO_ID, LINK, FECHA_PUBLICACION, DESCRIPCION) VALUES (?, ?, ?, ?)");
            $stmt->bind_param ("isss", $usuario_id, $link, $fecha, $descripcion);

            if ($stmt-> execute()){
                $mensaje = 'Publicacion Exitosa';
            } else {
                $error = 'Fallo al guardar la publicacion: '. $conexion -> error;
            }
            }
        }
    }
    ?> 

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Hacer una publicacion</h4>
                </div>
                <div class="card-body">
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    
                    <form method="POST" action="Post.php">
                        <div class="mb-3">
                            <label for="Titulo" class="form-label">Titulo</label>
                            <input type="text" class="form-control" id="Titulo" name="Titulo" required>
                        </div>
                        <div class="mb-3">
                            <label for="Descripcion" class="form-label">Descripcion</label>
                            <input type="text" class="form-control" id="Descripcion" name="Descripcion" required>
                        </div>
                        <div class="mb-3">
                            <label for="Link" class="form-label">Link</label>
                            <input type="text" class="form-control" id="Link" name="Link" required>
                        </div>
                        <div class="d-flex justify-content-between">
                       <button type="submit" class="btn btn-success">Publicar</button>
                       <a href="../foro.php" class="btn btn-success">Volver al foro</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once ('../includes/footer.php'); ?>