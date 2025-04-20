<?php
    require_once ('functions/conexion.php');
    require_once ('functions/auth.php');
    require_once ('includes/header.php');
    require_once ('includes/navbar.php');
?>

<main>
    <!-- Contenido principal de la página -->
    <section class="hero-section">

        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        
        <div class="container hero-content">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-3 fw-bold mb-4">Título Impactante</h1>
                    <p class="lead fs-4 mb-5">Este es un hero section con imagen de fondo que ahora sí debería verse correctamente en todos los dispositivos.</p>
                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                        <button class="btn btn-primary btn-lg px-4">Botón Principal</button>
                        <button class="btn btn-outline-light btn-lg px-4">Botón Secundario</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</main>

<!-- Modal de bienvenida para usuarios no autenticados -->
<?php if (!isset($_SESSION['usuario'])): ?>
<div class="modal fade" id="welcomeModal" tabindex="-1" aria-labelledby="welcomeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="welcomeModalLabel">Bienvenido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Por favor, inicia sesión o regístrate para acceder a todas las funcionalidades.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <a href="functions/register.php" class="btn btn-success" id="registerButton">Registrarse</a>
                <a href="functions/login.php" class="btn btn-primary" id="loginButton">Iniciar Sesión</a>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Toast para usuarios que acaban de iniciar sesión -->
<?php if (isset($_SESSION['login_success'])): ?>
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="welcomeToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">¡Bienvenido!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            ¡Hola, <?php echo $_SESSION['usuario']['NOMBRE']; ?>! Has iniciado sesión correctamente.
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var welcomeToast = new bootstrap.Toast(document.getElementById('welcomeToast'));
        welcomeToast.show();
    });
</script>
<?php 
    // Limpiar la variable de sesión después de mostrar el toast
    unset($_SESSION['login_success']);
endif; 
?>

<!-- Script para el modal de bienvenida -->
<?php if (!isset($_SESSION['usuario'])): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mostrar el modal para usuarios no autenticados
        var welcomeModal = new bootstrap.Modal(document.getElementById('welcomeModal'));
        welcomeModal.show();
        
        // Configurar el temporizador para ocultar el modal y el botón de login
        setTimeout(function() {
            var loginButton = document.getElementById('loginButton');
            if (loginButton) {
                loginButton.style.display = 'none';
            }
            
            setTimeout(function() {
                welcomeModal.hide();
            }, 500);
        }, 5000); // 5 segundos
    });
</script>
<?php endif; ?>

<?php require_once ('includes/footer.php'); ?>