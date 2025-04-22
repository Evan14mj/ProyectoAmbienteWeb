<?php 
    require_once('../includes/header.php');
    require_once('../includes/navbar.php');

    $error = ""; 
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
                    
                    <form method="POSTP" action="register.php">
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
                        <button type="submit" class="btn btn-success w-100">Publicar</button>
                    </form>
                    <div class="mt-3 text-center">
                        <p>¿Ya hiciste una publicacion? <a href="../foro.php">Vuelve al foro</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once ('../includes/footer.php'); ?>