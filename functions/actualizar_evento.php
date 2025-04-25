<?php
require_once('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['evento_id'];
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $ubicacion = $_POST['ubicacion'];
    $tipo = $_POST['tipo_actividad'];
    $descripcion = $_POST['descripcion'];
    $organizador_id = $_POST['organizador_id'];

    $query = "UPDATE eventos SET NOMBRE=?, FECHA=?, UBICACION=?, TIPO_ACTIVIDAD=?, DESCRIPCION=?, ORGANIZADOR_ID=?
              WHERE EVENTO_ID=?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ssssssi", $nombre, $fecha, $ubicacion, $tipo, $descripcion, $organizador_id, $id);

    if ($stmt->execute()) {
        header("Location: ../ver_eventos.php?mensaje=Evento actualizado correctamente");
        exit;
    } else {
        echo "Error al actualizar el evento: " . $conexion->error;
    }
}
?>
