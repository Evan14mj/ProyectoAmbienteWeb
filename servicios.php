<?php
    require_once ('functions/conexion.php');
    require_once ('functions/auth.php');
    require_once ('includes/header.php');
    require_once ('includes/navbar.php');
?>

<main>
    <div class="container py-5">
        <h1 class="mb-4 text-center">Nuestros Servicios</h1>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Asesoría Deportiva</h5>
                        <p class="card-text">Ofrecemos planes personalizados para mejorar tu desempeño físico y adoptar un estilo de vida saludable.</p>
                        <a href="#" class="btn btn-primary">Más información</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Eventos Comunitarios</h5>
                        <p class="card-text">Organización de eventos deportivos y recreativos para promover la actividad física en la comunidad.</p>
                        <a href="ver_eventos.php" class="btn btn-primary">Ver eventos</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Foros de Discusión</h5>
                        <p class="card-text">Comparte experiencias y conocimientos con otros miembros de la comunidad en nuestros foros temáticos.</p>
                        <a href="foro.php" class="btn btn-primary">Acceder al foro</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-12 text-center">
                <p class="lead">¿Necesitas más información sobre nuestros servicios?</p>
                <a href="#" class="btn btn-success">Contáctanos</a>
            </div>
        </div>
    </div>
</main>

<?php require_once ('includes/footer.php'); ?> 