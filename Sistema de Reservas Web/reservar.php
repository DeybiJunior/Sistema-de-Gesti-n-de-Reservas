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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = $_POST['id_cliente'];
    $id_sede = $_POST['id_sede'];
    $fecha = $_POST['fecha'];
    $hora_ingreso = $_POST['hora_ingreso'];
    $num_acompanantes = $_POST['num_acompanantes'];

    $stmt_cliente = $conn->prepare("SELECT id_cliente FROM Clientes WHERE id_cliente = ?");
    $stmt_cliente->bind_param("i", $id_cliente);
    $stmt_cliente->execute();
    $stmt_cliente->store_result();
    
    // Calcular la hora de salida (ingreso + 2 horas)
    $hora_salida = date("H:i:s", strtotime($hora_ingreso) + 2 * 3600);
    
    $stmt_horario = $conn->prepare("SELECT horario_apertura, horario_cierre, capacidad_maxima FROM Sedes WHERE id_sede = ?");
    $stmt_horario->bind_param("i", $id_sede);
    $stmt_horario->execute();
    $stmt_horario->bind_result($horario_apertura, $horario_cierre, $capacidad_maxima);
    $stmt_horario->fetch();
    $stmt_horario->close();
    
    if ($hora_ingreso < $horario_apertura || $hora_salida > $horario_cierre) {
        echo "Error: La reserva debe estar dentro del horario de operación ($horario_apertura - $horario_cierre).";
        exit;
    }
    
    $stmt_capacidad = $conn->prepare("SELECT IFNULL(SUM(num_acompanantes + 1), 0) FROM Reservas WHERE id_sede = ? AND fecha = ? AND 
                                      (hora_ingreso < ? AND ADDTIME(hora_ingreso, '02:00:00') > ?)");
    $stmt_capacidad->bind_param("isss", $id_sede, $fecha, $hora_salida, $hora_ingreso);
    $stmt_capacidad->execute();
    $stmt_capacidad->bind_result($personas_reservadas);
    $stmt_capacidad->fetch();
    $stmt_capacidad->close();
    
    if ($personas_reservadas + $num_acompanantes + 1 > $capacidad_maxima) {
        echo "Error: Capacidad máxima alcanzada para la sede seleccionada.";
        exit;
    }
    
    $stmt_cruces = $conn->prepare("SELECT COUNT(*) FROM Reservas WHERE id_cliente = ? AND fecha = ? AND 
                                   (hora_ingreso < ? AND ADDTIME(hora_ingreso, '02:00:00') > ?)");
    $stmt_cruces->bind_param("isss", $id_cliente, $fecha, $hora_salida, $hora_ingreso);
    $stmt_cruces->execute();
    $stmt_cruces->bind_result($reservas_cruzadas);
    $stmt_cruces->fetch();
    $stmt_cruces->close();
    
    if ($reservas_cruzadas > 0) {
        echo "Error: Ya tienes una reserva en este horario.";
        exit;
    }
    
    $stmt_insert = $conn->prepare("INSERT INTO Reservas (id_cliente, id_sede, fecha, hora_ingreso, num_acompanantes) VALUES (?, ?, ?, ?, ?)");
    $stmt_insert->bind_param("iissi", $id_cliente, $id_sede, $fecha, $hora_ingreso, $num_acompanantes);
    
    if ($stmt_insert->execute()) {
        echo "Reserva registrada con éxito.";
    } else {
        echo "Error al registrar la reserva: " . $conn->error;
    }
    $stmt_insert->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Reservas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilotabla.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Registrar Nueva Reserva</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="id_cliente" class="form-label">DNI Cliente <i class="bi bi-person-fill"></i></label>
                <input type="number" id="id_cliente" name="id_cliente" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="id_sede" class="form-label">Sede <i class="bi bi-house-door-fill"></i></label>
                <select id="id_sede" name="id_sede" class="form-select" required>
                    <option value="">Seleccione una sede</option>
                    <?php foreach ($sedes as $sede): ?>
                        <option value="<?= $sede['id']; ?>"><?= htmlspecialchars($sede['nombre']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha <i class="bi bi-calendar-fill"></i></label>
                <input type="date" id="fecha" name="fecha" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="hora_ingreso" class="form-label">Hora de Ingreso <i class="bi bi-clock-fill"></i></label>
                <input type="time" id="hora_ingreso" name="hora_ingreso" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="num_acompanantes" class="form-label">Número de Acompañantes <i class="bi bi-person-plus-fill"></i></label>
                <input type="number" id="num_acompanantes" name="num_acompanantes" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary w-100">Registrar Reserva</button>
        </form>
    </div>

    

    <!-- Vincula Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

