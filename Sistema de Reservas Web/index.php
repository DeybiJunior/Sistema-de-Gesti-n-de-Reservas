<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Índice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .card-custom {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Bienvenido al Sistema de Reservas</h2>

        <div class="row">
            <!-- Card para el cliente -->
            <div class="col-md-6 mb-4">
                <div class="card card-custom">
                    <img src="recursos/R.jfif" class="card-img-top" alt="Imagen Cliente">
                    <div class="card-body">
                        <h5 class="card-title">Reservar una Sede</h5>
                        <p class="card-text">Haz clic aquí para realizar tu reserva de sede.</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="reservar.php" class="btn btn-primary">Reservar</a>
                    </div>
                </div>
            </div>

            <!-- Card para el dueño -->
            <div class="col-md-6 mb-4">
                <div class="card card-custom">
                    <img src="recursos/rr.jfif" class="card-img-top" alt="Imagen Dueño">
                    <div class="card-body">
                        <h5 class="card-title">Ver Reservas</h5>
                        <p class="card-text">Haz clic aquí para ver las reservas realizadas por los clientes.</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="listarreserva.php" class="btn btn-secondary">Ver Reservas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vincula Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
