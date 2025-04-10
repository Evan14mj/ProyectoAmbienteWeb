<?php
    require_once ('includes/header.php');
    require_once ('includes/navbar.php');
?>
    
    <main class="container">
        <section class="gest-solicitudes">
            <h2>SOLICITUDES DE INSCRIPCIÓN</h2>
            <div class="lista-solicitudes">
                <div class="solicitudes">
                    <h3>SOLICITUD USUARIO 1</h3>
                    <a href="gestionSolicitudes1.html">
                        <button class="abrir-solicitud">⌃</button>
                    </a>
                </div>
                <div class="solicitudes">
                    <h3>SOLICITUD USUARIO 2</h3>
                    <a href="gestionSolicitudes2.html">
                        <button class="abrir-solicitud">⌃</button>
                    </a>
                </div>
                <div class="solicitudes">
                    <h3>SOLICITUD USUARIO 3</h3>
                    <a href="gestionSolicitudes3.html">
                        <button class="abrir-solicitud">⌃</button>
                    </a>
                </div>
            </div>
        </section>
    </main>

<?php require_once ('includes/footer.php'); ?>

