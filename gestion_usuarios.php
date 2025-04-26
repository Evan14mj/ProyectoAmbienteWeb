<?php
require_once('functions/conexion.php');
require_once('functions/auth.php');
require_once('functions/user_roles.php');
require_once('includes/header.php');
require_once('includes/navbar.php');

// Verificar si el usuario es administrador
requiereRol('admin');

// Obtener la lista de usuarios de la base de datos
$usuarios = [];
$sql = "SELECT USUARIOS_ID, NOMBRE, APELLIDO, EMAIL, ROL, FECHA_REGISTRO FROM usuarios ORDER BY FECHA_REGISTRO DESC";
$resultado = $conexion->query($sql);

if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $usuarios[] = $fila;
    }
}
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['error']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['success']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Gestión de Usuarios</h4>
                </div>
                <div class="card-body">
                    <?php if (count($usuarios) > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Email</th>
                                        <th>Rol</th>
                                        <th>Fecha Registro</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($usuarios as $user): ?>
                                        <tr>
                                            <td><?php echo $user['USUARIOS_ID']; ?></td>
                                            <td><?php echo $user['NOMBRE']; ?></td>
                                            <td><?php echo $user['APELLIDO']; ?></td>
                                            <td><?php echo $user['EMAIL']; ?></td>
                                            <td>
                                                <span class="badge bg-<?php echo $user['ROL'] === 'admin' ? 'danger' : 'primary'; ?>">
                                                    <?php echo ucfirst($user['ROL']); ?>
                                                </span>
                                            </td>
                                            <td><?php echo $user['FECHA_REGISTRO']; ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="editar_usuario.php?id=<?php echo $user['USUARIOS_ID']; ?>" class="btn btn-sm btn-warning">Editar</a>
                                                    <?php if ($user['USUARIOS_ID'] != $_SESSION['usuario']['USUARIOS_ID']): ?>
                                                        <a href="javascript:void(0);" onclick="confirmarEliminar(<?php echo $user['USUARIOS_ID']; ?>)" class="btn btn-sm btn-danger">Eliminar</a>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            No hay usuarios registrados en el sistema.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmación para eliminar usuario -->
<div class="modal fade" id="confirmarEliminarModal" tabindex="-1" aria-labelledby="confirmarEliminarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmarEliminarModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="#" id="btnEliminarUsuario" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmarEliminar(userId) {
        // Configurar el href del botón de eliminar con el ID del usuario
        document.getElementById('btnEliminarUsuario').href = 'eliminar_usuario.php?id=' + userId;
        
        // Mostrar el modal de confirmación
        var modal = new bootstrap.Modal(document.getElementById('confirmarEliminarModal'));
        modal.show();
    }
</script>

<?php require_once('includes/footer.php'); ?> 