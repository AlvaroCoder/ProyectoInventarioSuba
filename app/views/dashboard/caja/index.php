<!-- app/views/inventario/inventario.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
                body {
            background-color: #f8f9fa;
        }
        .kpi-card {
            border-radius: 12px;
            transition: transform 0.2s ease;
        }
        .kpi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .progress {
            height: 12px;
            border-radius: 8px;
        }
        .sidebar {
            background: linear-gradient(180deg, #0d6efd, #0b5ed7);
            color: #fff;
            height: 100vh;
            position: fixed;
            width: 250px;
        }
        .sidebar .nav-link {
            color: #fff;
            font-weight: 500;
        }
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.2);
            border-radius: 8px;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        @media(max-width: 768px) {
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body class="bg-light">

<?php require_once __DIR__ . '/../../layout/sidebar.php' ?>
<section class="main-content">
<div class="container-fluid py-3">
    <!-- Header Caja -->
    <div class="row mb-3">
        <div class="col-md-6">
            <h3 class="fw-bold">🛒 Caja Principal</h3>
            <p class="mb-0">Fecha: <span id="fecha-actual"></span></p>
            <p class="mb-0">Hora: <span id="hora-actual"></span></p>
        </div>
        <div class="col-md-6 text-md-end">
            <p class="mb-0 fw-bold">Cajero: <span>Juan Pérez</span></p>
            <p class="mb-0">N° Transacción: <span>#000123</span></p>
        </div>
    </div>

    <!-- Resumen de venta en curso -->
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <h5 class="card-title fw-bold">Resumen de Venta</h5>
            <table class="table table-sm align-middle">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unit.</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Ejemplo de producto en venta -->
                    <tr>
                        <td>Alimento Balanceado</td>
                        <td>2</td>
                        <td>S/ 15.00</td>
                        <td>S/ 30.00</td>
                        <td>
                            <button class="btn btn-sm btn-danger">❌</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Totales -->
            <div class="d-flex justify-content-end">
                <div class="text-end">
                    <p class="mb-0">Subtotal: <strong>S/ 30.00</strong></p>
                    <p class="mb-0">Descuento: <strong>S/ 0.00</strong></p>
                    <p class="mb-0">Impuestos: <strong>S/ 5.40</strong></p>
                    <h5 class="fw-bold">Total: S/ 35.40</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- KPIs -->
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6>Total Ventas del Día</h6>
                    <h4 class="fw-bold text-success">S/ 1,250.00</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6>Ticket Promedio</h6>
                    <h4 class="fw-bold">S/ 45.20</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6>N° Transacciones</h6>
                    <h4 class="fw-bold">28</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Botones de acceso rápido -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title fw-bold">Accesos Rápidos</h5>
            <div class="d-flex flex-wrap gap-2">
                <button class="btn btn-success">💵 Cobrar Efectivo</button>
                <button class="btn btn-primary">💳 Cobrar Tarjeta</button>
                <button class="btn btn-info">📲 Cobrar QR</button>
                <button class="btn btn-secondary">➕ Añadir Producto</button>
                <button class="btn btn-warning">🏷️ Descuento</button>
                <button class="btn btn-danger">❌ Anular Transacción</button>
                <button class="btn btn-dark">📊 Arqueo de Caja</button>
                <button class="btn btn-outline-secondary">💰 Ingresos/Egresos</button>
            </div>
        </div>
    </div>
</div>
</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Mostrar fecha y hora en tiempo real
    function actualizarFechaHora() {
        const fecha = new Date();
        document.getElementById("fecha-actual").textContent = fecha.toLocaleDateString("es-PE");
        document.getElementById("hora-actual").textContent = fecha.toLocaleTimeString("es-PE");
    }
    setInterval(actualizarFechaHora, 1000);
    actualizarFechaHora();
</script>
</body>
</html>




