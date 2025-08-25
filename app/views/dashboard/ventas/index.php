<!-- app/views/dashboard/ventas/index.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
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
<div class="container my-4">
    <h2 class="mb-4 text-primary fw-bold">Gestión de Ventas</h2>

    <!-- KPIs -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card text-center shadow-sm kpi-card">
                <div class="card-body">
                    <h6 class="text-muted">Total Ventas Día</h6>
                    <h3 class="fw-bold text-success">S/ 3,450</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center shadow-sm kpi-card">
                <div class="card-body">
                    <h6 class="text-muted">Ticket Promedio</h6>
                    <h3 class="fw-bold text-primary">S/ 57.50</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center shadow-sm kpi-card">
                <div class="card-body">
                    <h6 class="text-muted">N° Transacciones</h6>
                    <h3 class="fw-bold text-warning">60</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center shadow-sm kpi-card">
                <div class="card-body">
                    <h6 class="text-muted">Ingresos Semana</h6>
                    <h3 class="fw-bold text-info">S/ 12,800</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Barra de filtros y acciones -->
    <div class="card p-3 mb-4 shadow-sm">
        <div class="row g-3 align-items-center">
            <div class="col-md-3">
                <select class="form-select">
                    <option value="">Filtrar por...</option>
                    <option>Hoy</option>
                    <option>Esta Semana</option>
                    <option>Este Mes</option>
                </select>
            </div>
            <div class="col-md-6 d-flex gap-2">
                <button class="btn btn-success">Generar Boleta</button>
                <button class="btn btn-primary">Nueva Venta</button>
            </div>
        </div>
    </div>

    <!-- Tabla de Ventas -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3 fw-bold">Historial de Ventas</h5>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th># Transacción</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Productos</th>
                            <th>Subtotal</th>
                            <th>Descuento</th>
                            <th>Total</th>
                            <th>Método de Pago</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>TXN001</td>
                            <td>2025-08-16</td>
                            <td>Juan Pérez</td>
                            <td>3</td>
                            <td>S/ 150.00</td>
                            <td>S/ 10.00</td>
                            <td>S/ 140.00</td>
                            <td>Efectivo</td>
                            <td>
                                <button class="btn btn-sm btn-secondary">Ver</button>
                                <button class="btn btn-sm btn-success">Boleta</button>
                            </td>
                        </tr>
                        <tr>
                            <td>TXN002</td>
                            <td>2025-08-16</td>
                            <td>Ana Torres</td>
                            <td>5</td>
                            <td>S/ 250.00</td>
                            <td>S/ 0.00</td>
                            <td>S/ 250.00</td>
                            <td>Tarjeta</td>
                            <td>
                                <button class="btn btn-sm btn-secondary">Ver</button>
                                <button class="btn btn-sm btn-success">Boleta</button>
                            </td>
                        </tr>
                        <tr>
                            <td>TXN003</td>
                            <td>2025-08-15</td>
                            <td>Carlos Gómez</td>
                            <td>2</td>
                            <td>S/ 80.00</td>
                            <td>S/ 5.00</td>
                            <td>S/ 75.00</td>
                            <td>QR</td>
                            <td>
                                <button class="btn btn-sm btn-secondary">Ver</button>
                                <button class="btn btn-sm btn-success">Boleta</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>