<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <span class="fw-bold">LOGO</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="servicios.php">Servicios</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Actividades
          </a>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="actividades.php">Ver Actividades</a></li>
            <li><a class="dropdown-item" href="inscripcion.php">Inscripción</a></li>
            <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['ROL'] === 'admin'): ?>
            <li><a class="dropdown-item" href="gestionSolicitudes.php">Gestión de Solicitudes</a></li>
            <?php endif; ?>
          </ul>
        </li>
      </ul>
      
      <div class="d-flex align-items-center">
        <?php if (isset($_SESSION['usuario'])): ?>
          <span class="text-light me-3">Hola, <?php echo $_SESSION['usuario']['NOMBRE']; ?></span>
          <a href="functions/logout.php" class="btn btn-outline-danger btn-sm">Cerrar Sesión</a>
        <?php else: ?>
          <a href="functions/register.php" class="btn btn-outline-success btn-sm me-2">Registrarse</a>
          <a href="functions/login.php" class="btn btn-outline-primary btn-sm">Iniciar Sesión</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>