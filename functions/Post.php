<?php 
    
    require_once('conexion.php');
    
    // Verifica si la sesión ya está iniciada antes de intentar iniciarla
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    require_once('../includes/header.php');
    require_once('../includes/navbar.php');

    $error = ""; 
    $succes = "";
    $redirect = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (!isset($_SESSION['usuario'])){
            $error = 'Debes iniciar sesión para poder publicar';
        } else {
            $usuario_id = $_SESSION['usuario']['USUARIOS_ID'];
            $contenido = $_POST['Contenido'] ?? '';
            $tipo = $_POST['Tipo'] ?? '';
            $fecha = date('Y-m-d');

            if(empty($contenido) || empty($tipo)){
                $error = 'Por favor, llena todos los campos';
            } else {
                $stmt = $conexion->prepare("INSERT INTO foro (USUARIO_ID, CONTENIDO, FECHA_PUBLICACION, TIPO) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("isss", $usuario_id, $contenido, $fecha, $tipo);

                if ($stmt->execute()){
                    $succes = 'Publicación exitosa';
                    // Activar la bandera de redirección
                    $redirect = true;
                } else {
                    $error = 'Error al guardar la publicación: '. $conexion->error;
                }
            }
        }
    }
?> 

<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="../foro.php">Foro</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nueva publicación</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-edit"></i> Crear nueva publicación</h4>
                </div>
                <div class="card-body">
                    <?php if ($error): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($succes): ?>
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i> <?php echo $succes; ?>
                            <div class="mt-2">Redirigiendo al foro...</div>
                        </div>
                        
                        <!-- Redirección mediante JavaScript después de 2 segundos -->
                        <script>
                            setTimeout(function() {
                                window.location.href = '../foro.php';
                            }, 2000);
                        </script>
                    <?php endif; ?>
                    
                    <?php if (!isset($_SESSION['usuario'])): ?>
                        <div class="alert alert-warning">
                            <i class="fas fa-info-circle"></i> Debes <a href="login.php" class="alert-link">iniciar sesión</a> o <a href="register.php" class="alert-link">registrarte</a> para publicar en el foro.
                        </div>
                    <?php endif; ?>
                    
                    <?php if (!$succes): ?>
                    <form method="POST" action="Post.php">
                        <div class="mb-3">
                            <label for="Tipo" class="form-label"><i class="fas fa-tag"></i> Tipo de publicación</label>
                            <select class="form-select" id="Tipo" name="Tipo" required>
                                <option value="" selected disabled>Selecciona un tipo</option>
                                <option value="video">Video</option>
                                <option value="articulo">Artículo</option>
                                <option value="pregunta">Pregunta</option>
                                <option value="consejo">Consejo</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="Contenido" class="form-label"><i class="fas fa-align-left"></i> Contenido</label>
                            <textarea class="form-control" id="Contenido" name="Contenido" rows="6" required
                                      placeholder="Escribe aquí tu publicación..."></textarea>
                            <div class="form-text">Comparte información, preguntas o contenido relacionado con actividades deportivas.</div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success" <?php echo !isset($_SESSION['usuario']) ? 'disabled' : ''; ?>>
                                <i class="fas fa-paper-plane"></i> Publicar
                            </button>
                            <a href="../foro.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Volver al foro
                            </a>
                        </div>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
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

<?php require_once('../includes/footer.php'); ?>