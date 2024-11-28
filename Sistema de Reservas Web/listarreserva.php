<?php
include 'conexion.php';

// Consulta de sedes
$sedes = [];
$stmt_sedes = $conn->prepare("SELECT id_sede, nombre_sede FROM Sedes");
$stmt_sedes->execute();
$stmt_sedes->bind_result($id_sede, $nombre_sede);
while ($stmt_sedes->fetch()) {
    $sedes[] = ["id" => $id_sede, "nombre" => $nombre_sede];
}
$stmt_sedes->close();

// Variables de filtro
$nombre_cliente = isset($_POST['nombre_cliente']) ? $_POST['nombre_cliente'] : '';
$id_sede_filtro = isset($_POST['id_sede']) ? $_POST['id_sede'] : '';

// Consulta de reservas con filtros
$sql = "SELECT 
            r.id_reserva, 
            c.nombre AS cliente, 
            s.nombre_sede, 
            r.fecha, 
            r.hora_ingreso, 
            ADDTIME(r.hora_ingreso, '02:00:00') AS hora_salida, 
            r.num_acompanantes 
        FROM Reservas r
        JOIN Clientes c ON r.id_cliente = c.id_cliente
        JOIN Sedes s ON r.id_sede = s.id_sede
        WHERE 1=1";

// Aplicar filtros de búsqueda
if ($nombre_cliente !== '') {
    $sql .= " AND c.nombre LIKE ?";
}
if ($id_sede_filtro !== '') {
    $sql .= " AND s.id_sede = ?";
}

$sql .= " ORDER BY s.nombre_sede, r.fecha, r.hora_ingreso";

// Preparar y ejecutar la consulta
$stmt = $conn->prepare($sql);

// Verificar qué parámetros se necesitan y pasarlos como referencias
if ($nombre_cliente !== '' && $id_sede_filtro !== '') {
    $param_nombre = "%$nombre_cliente%";  // Agregar el % antes y después del nombre para la búsqueda LIKE
    $stmt->bind_param("si", $param_nombre, $id_sede_filtro);  // "s" para string y "i" para integer
} elseif ($nombre_cliente !== '') {
    $param_nombre = "%$nombre_cliente%";
    $stmt->bind_param("s", $param_nombre);  // Solo el filtro por nombre
} elseif ($id_sede_filtro !== '') {
    $stmt->bind_param("i", $id_sede_filtro);  // Solo el filtro por sede
}

$stmt->execute();
$result = $stmt->get_result();

$reservas = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $reservas[] = $row;
    }
} else {
    echo "No hay reservas para mostrar.";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cronograma de Reservas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilotabla.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Cronograma de Reservas</h2>

        <form method="POST" class="mb-4">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <input type="text" class="form-control" name="nombre_cliente" placeholder="Buscar por nombre de cliente" value="<?= htmlspecialchars($nombre_cliente); ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <select class="form-select" name="id_sede">
                        <option value="">Seleccionar sede</option>
                        <?php foreach ($sedes as $sede): ?>
                            <option value="<?= $sede['id']; ?>" <?= $id_sede_filtro == $sede['id'] ? 'selected' : ''; ?>><?= $sede['nombre']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered table-striped mt-4">
            <thead class="table-dark">
                <tr>
                    <th>Cliente</th>
                    <th>Sede</th>
                    <th>Fecha</th>
                    <th>Hora de Ingreso</th>
                    <th>Hora de Salida</th>
                    <th>Acompañantes</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservas as $reserva): ?>
                <tr>
                    <td><?= $reserva['cliente']; ?></td>
                    <td><?= $reserva['nombre_sede']; ?></td>
                    <td><?= $reserva['fecha']; ?></td>
                    <td><?= $reserva['hora_ingreso']; ?></td>
                    <td><?= $reserva['hora_salida']; ?></td>
                    <td><?= $reserva['num_acompanantes']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
