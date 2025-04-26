<?php
require_once('functions/conexion.php');
require_once('functions/user_roles.php');
require_once('includes/header.php');
require_once('includes/navbar.php');

// Inicializar filtros
$filtro_ubicacion = isset($_GET['ubicacion']) ? $_GET['ubicacion'] : '';
$filtro_fecha_inicio = isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : '';
$filtro_fecha_fin = isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : '';
$filtro_tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';

// Obtener lista de ubicaciones para el filtro
$ubicaciones = [];
$query_ubicaciones = "SELECT DISTINCT UBICACION FROM eventos ORDER BY UBICACION";
$result_ubicaciones = $conexion->query($query_ubicaciones);
if ($result_ubicaciones && $result_ubicaciones->num_rows > 0) {
    while ($row = $result_ubicaciones->fetch_assoc()) {
        $ubicaciones[] = $row['UBICACION'];
    }
}

// Obtener lista de tipos de actividad para el filtro
$tipos_actividad = [];
$query_tipos = "SELECT DISTINCT TIPO_ACTIVIDAD FROM eventos ORDER BY TIPO_ACTIVIDAD";
$result_tipos = $conexion->query($query_tipos);
if ($result_tipos && $result_tipos->num_rows > 0) {
    while ($row = $result_tipos->fetch_assoc()) {
        $tipos_actividad[] = $row['TIPO_ACTIVIDAD'];
    }
}

// Construir la consulta con los filtros
$query = "SELECT EVENTO_ID, NOMBRE, FECHA, UBICACION, TIPO_ACTIVIDAD, DESCRIPCION 
          FROM eventos 
          WHERE 1=1";

$params = [];
$types = "";

if (!empty($filtro_ubicacion)) {
    $query .= " AND UBICACION = ?";
    $params[] = $filtro_ubicacion;
    $types .= "s";
}

if (!empty($filtro_fecha_inicio)) {
    $query .= " AND FECHA >= ?";
    $params[] = $filtro_fecha_inicio;
    $types .= "s";
}

if (!empty($filtro_fecha_fin)) {
    $query .= " AND FECHA <= ?";
    $params[] = $filtro_fecha_fin;
    $types .= "s";
}

if (!empty($filtro_tipo)) {
    $query .= " AND TIPO_ACTIVIDAD = ?";
    $params[] = $filtro_tipo;
    $types .= "s";
}

$query .= " ORDER BY FECHA ASC";

// Preparar y ejecutar la consulta
$stmt = $conexion->prepare($query);
if ($stmt) {
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $eventos = [];
    
    if ($result && $result->num_rows > 0) {
        while ($evento = $result->fetch_assoc()) {
            $eventos[] = $evento;
        }
    }
    $stmt->close();
} else {
    echo "Error en la consulta: " . $conexion->error;
}

// Agrupar eventos por mes y día para el calendario
$eventos_por_fecha = [];
foreach ($eventos as $evento) {
    $fecha = new DateTime($evento['FECHA']);
    $año_mes = $fecha->format('Y-m');
    $dia = $fecha->format('d');
    
    if (!isset($eventos_por_fecha[$año_mes])) {
        $eventos_por_fecha[$año_mes] = [];
    }
    
    if (!isset($eventos_por_fecha[$año_mes][$dia])) {
        $eventos_por_fecha[$año_mes][$dia] = [];
    }
    
    $eventos_por_fecha[$año_mes][$dia][] = $evento;
}

// Determinar el mes actual para mostrar por defecto
$mes_actual = isset($_GET['mes']) ? $_GET['mes'] : date('Y-m');
$fecha_mes = new DateTime($mes_actual . '-01');
$primer_dia_mes = (int)$fecha_mes->format('N'); // 1 (lunes) a 7 (domingo)
$dias_mes = (int)$fecha_mes->format('t'); // Número de días en el mes
?>

<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-light">
                <div class="card-body">
                    <h2 class="text-center">Calendario de Eventos</h2>
                    <p class="text-center text-muted">Visualiza y filtra eventos por fecha y ubicación</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-filter"></i> Filtrar Eventos</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="calendario_eventos.php" class="row g-3">
                        <div class="col-md-3">
                            <label for="fecha_inicio" class="form-label">Desde</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" 
                                   value="<?php echo $filtro_fecha_inicio; ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="fecha_fin" class="form-label">Hasta</label>
                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" 
                                   value="<?php echo $filtro_fecha_fin; ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="ubicacion" class="form-label">Ubicación</label>
                            <select class="form-select" id="ubicacion" name="ubicacion">
                                <option value="">Todas las ubicaciones</option>
                                <?php foreach ($ubicaciones as $ubicacion): ?>
                                    <option value="<?php echo htmlspecialchars($ubicacion); ?>" 
                                            <?php echo $filtro_ubicacion === $ubicacion ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($ubicacion); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="tipo" class="form-label">Tipo de Actividad</label>
                            <select class="form-select" id="tipo" name="tipo">
                                <option value="">Todos los tipos</option>
                                <?php foreach ($tipos_actividad as $tipo): ?>
                                    <option value="<?php echo htmlspecialchars($tipo); ?>" 
                                            <?php echo $filtro_tipo === $tipo ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($tipo); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Filtrar
                            </button>
                            <a href="calendario_eventos.php" class="btn btn-secondary">
                                <i class="fas fa-undo"></i> Limpiar Filtros
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Navegación del calendario -->
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <?php
            $mes_anterior = new DateTime($mes_actual . '-01');
            $mes_anterior->modify('-1 month');
            
            $mes_siguiente = new DateTime($mes_actual . '-01');
            $mes_siguiente->modify('+1 month');
            ?>
            
            <a href="?mes=<?php echo $mes_anterior->format('Y-m'); ?>&ubicacion=<?php echo urlencode($filtro_ubicacion); ?>&fecha_inicio=<?php echo urlencode($filtro_fecha_inicio); ?>&fecha_fin=<?php echo urlencode($filtro_fecha_fin); ?>&tipo=<?php echo urlencode($filtro_tipo); ?>" class="btn btn-outline-primary">
                <i class="fas fa-chevron-left"></i> <?php echo $mes_anterior->format('F Y'); ?>
            </a>
            
            <h3><?php echo $fecha_mes->format('F Y'); ?></h3>
            
            <a href="?mes=<?php echo $mes_siguiente->format('Y-m'); ?>&ubicacion=<?php echo urlencode($filtro_ubicacion); ?>&fecha_inicio=<?php echo urlencode($filtro_fecha_inicio); ?>&fecha_fin=<?php echo urlencode($filtro_fecha_fin); ?>&tipo=<?php echo urlencode($filtro_tipo); ?>" class="btn btn-outline-primary">
                <?php echo $mes_siguiente->format('F Y'); ?> <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </div>

    <!-- Calendario -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body p-0">
                    <table class="table table-bordered calendar-table mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center">Lunes</th>
                                <th class="text-center">Martes</th>
                                <th class="text-center">Miércoles</th>
                                <th class="text-center">Jueves</th>
                                <th class="text-center">Viernes</th>
                                <th class="text-center">Sábado</th>
                                <th class="text-center">Domingo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Calcular el número de semanas en el mes
                            $semanas = ceil(($primer_dia_mes + $dias_mes - 1) / 7);
                            $dia_contador = 1 - ($primer_dia_mes - 1);
                            
                            for ($semana = 1; $semana <= $semanas; $semana++) {
                                echo '<tr style="height: 120px;">';
                                
                                for ($dia_semana = 1; $dia_semana <= 7; $dia_semana++) {
                                    echo '<td class="position-relative';
                                    
                                    // Verificar si el día está fuera del mes actual
                                    if ($dia_contador <= 0 || $dia_contador > $dias_mes) {
                                        echo ' bg-light">';
                                        echo '</td>';
                                    } else {
                                        // Verificar si hay eventos para este día
                                        $tiene_eventos = isset($eventos_por_fecha[$mes_actual][$dia_contador < 10 ? '0' . $dia_contador : $dia_contador]);
                                        if ($tiene_eventos) {
                                            echo ' has-events">';
                                        } else {
                                            echo '">';
                                        }
                                        
                                        echo '<div class="date-number">' . $dia_contador . '</div>';
                                        
                                        if ($tiene_eventos) {
                                            $eventos_dia = $eventos_por_fecha[$mes_actual][$dia_contador < 10 ? '0' . $dia_contador : $dia_contador];
                                            echo '<div class="events-container">';
                                            foreach ($eventos_dia as $index => $evento) {
                                                // Limitar a 3 eventos visibles por celda
                                                if ($index >= 3) {
                                                    $eventos_restantes = count($eventos_dia) - 3;
                                                    echo '<div class="more-events">+' . $eventos_restantes . ' más</div>';
                                                    break;
                                                }
                                                
                                                echo '<a href="detalle_evento.php?id=' . $evento['EVENTO_ID'] . '" class="event-item" data-bs-toggle="tooltip" title="' . htmlspecialchars($evento['NOMBRE']) . '">';
                                                echo '<div class="event-dot" style="background-color: ' . generarColorPorTipo($evento['TIPO_ACTIVIDAD']) . '"></div>';
                                                echo '<div class="event-title">' . htmlspecialchars(substr($evento['NOMBRE'], 0, 20)) . (strlen($evento['NOMBRE']) > 20 ? '...' : '') . '</div>';
                                                echo '</a>';
                                            }
                                            echo '</div>';
                                        }
                                        
                                        echo '</td>';
                                    }
                                    $dia_contador++;
                                }
                                
                                echo '</tr>';
                            }
                            
                            // Función para generar colores basados en el tipo de actividad
                            function generarColorPorTipo($tipo) {
                                $colores = [
                                    'Deportivo' => '#4CAF50',
                                    'Bienestar' => '#2196F3',
                                    'Recreativo' => '#FF9800',
                                    'Educativo' => '#9C27B0',
                                ];
                                
                                return isset($colores[$tipo]) ? $colores[$tipo] : '#607D8B';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Leyenda de colores -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Leyenda</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap">
                        <div class="me-4 mb-2">
                            <div class="d-flex align-items-center">
                                <div class="event-dot me-2" style="background-color: #4CAF50;"></div>
                                <div>Deportivo</div>
                            </div>
                        </div>
                        <div class="me-4 mb-2">
                            <div class="d-flex align-items-center">
                                <div class="event-dot me-2" style="background-color: #2196F3;"></div>
                                <div>Bienestar</div>
                            </div>
                        </div>
                        <div class="me-4 mb-2">
                            <div class="d-flex align-items-center">
                                <div class="event-dot me-2" style="background-color: #FF9800;"></div>
                                <div>Recreativo</div>
                            </div>
                        </div>
                        <div class="me-4 mb-2">
                            <div class="d-flex align-items-center">
                                <div class="event-dot me-2" style="background-color: #9C27B0;"></div>
                                <div>Educativo</div>
                            </div>
                        </div>
                        <div class="me-4 mb-2">
                            <div class="d-flex align-items-center">
                                <div class="event-dot me-2" style="background-color: #607D8B;"></div>
                                <div>Otros</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón para ver lista tradicional -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <a href="ver_eventos.php" class="btn btn-primary">
                <i class="fas fa-list"></i> Ver en formato lista
            </a>
            
            <?php if (isset($_SESSION['usuario']) && tieneRol('admin')): ?>
                <a href="crear_evento.php" class="btn btn-success ms-2">
                    <i class="fas fa-plus-circle"></i> Crear Nuevo Evento
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    .calendar-table th, .calendar-table td {
        width: 14.28%;
    }
    
    .date-number {
        font-weight: bold;
        position: absolute;
        top: 5px;
        left: 8px;
    }
    
    .events-container {
        margin-top: 25px;
        max-height: 85px;
        overflow-y: auto;
    }
    
    .event-item {
        display: flex;
        align-items: center;
        background-color: #f8f9fa;
        border-radius: 4px;
        padding: 3px 6px;
        margin-bottom: 3px;
        text-decoration: none;
        color: #333;
        font-size: 0.8rem;
    }
    
    .event-item:hover {
        background-color: #e9ecef;
    }
    
    .event-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin-right: 5px;
        flex-shrink: 0;
    }
    
    .event-title {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .more-events {
        font-size: 0.75rem;
        color: #666;
        text-align: center;
        margin-top: 2px;
    }
    
    .has-events {
        background-color: #f8fff8;
    }
</style>

<script>
    // Inicializar tooltips de Bootstrap
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

<?php require_once('includes/footer.php'); ?> 