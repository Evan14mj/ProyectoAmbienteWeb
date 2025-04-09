<?php require_once ('functions/conexion.php'); ?>
<!DOCTYPE html>
<html>
    

    <?php 
    inlcude ('includes/header.php');
    include ('includes/navbar.php'); 
    ?> 
    
        <main class="container">
            <section class="inscripciones">
                <h2>MIS INSCRIPCIONES</h2>
                <div class="eventos">
                    <h3>EVENTO 1</h3>
                    <p>Fecha de más próximo a menos</p>
                    <a href="inscripcionDetalle.html">
                        <button class="btn-detalles">Ver Detalles</button>
                    </a>
                    
                </div>
                <div class="eventos">
                    <h3>EVENTO 2</h3>
                    <p>Fecha de más próximo a menos</p>
                    <a href="inscripcionDetalle.html">
                        <button class="btn-detalles">Ver Detalles</button>
                    </a>
                </div>
                <div class="eventos">
                    <h3>EVENTO 3</h3>
                    <p>Fecha de más próximo a menos</p>
                    <a href="inscripcionDetalle.html">
                        <button class="btn-detalles">Ver Detalles</button>
                    </a>
                </div>
            </section>
        </main>
    </body>
</html>