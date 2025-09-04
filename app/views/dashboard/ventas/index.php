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
                    <h3 class="fw-bold text-success">S/ <?= number_format(isset($totalVentasDia), 2) ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center shadow-sm kpi-card">
                <div class="card-body">
                    <h6 class="text-muted">Ticket Promedio</h6>
                    <h3 class="fw-bold text-primary">S/ <?= number_format(isset($ticketPromedio), 2) ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center shadow-sm kpi-card">
                <div class="card-body">
                    <h6 class="text-muted">N° Transacciones</h6>
                    <h3 class="fw-bold text-warning"><?= $numeroTransacciones ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center shadow-sm kpi-card">
                <div class="card-body">
                    <h6 class="text-muted">Ingresos Semana</h6>
                    <h3 class="fw-bold text-info">S/ <?= number_format(isset($ingresosSemana['total_semana']), 2) ?></h3>
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
                <a href="/dashboard/ventas/generar_boleta" class="btn btn-success">Generar Boleta</a>
                <a href="/index.php?url=/dashboard/ventas/create" class="btn btn-primary">Nueva Venta</a>
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
                        <?php if (!empty($ventas)): ?>
                            <?php foreach ($ventas as $venta): ?>
                                <tr>
                                    <td><?= htmlspecialchars($venta['codigo_transaccion']) ?></td>
                                    <td><?= htmlspecialchars($venta['fecha']) ?></td>
                                    <td><?= htmlspecialchars($venta['cliente']) ?></td>
                                    <td><?= htmlspecialchars($venta['cantidad_productos']) ?></td>
                                    <td>S/ <?= number_format($venta['subtotal'], 2) ?></td>
                                    <td>S/ <?= number_format($venta['descuento'], 2) ?></td>
                                    <td>S/ <?= number_format($venta['total'], 2) ?></td>
                                    <td><?= htmlspecialchars($venta['metodo_pago']) ?></td>
                                    <td>
                                        <a href="/dashboard/ventas/ver/<?= $venta['id'] ?>" class="btn btn-sm btn-secondary">Ver</a>
                                        <a href="/dashboard/ventas/boleta/<?= $venta['id'] ?>" class="btn btn-sm btn-success">Boleta</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted">No hay ventas registradas.</td>
                            </tr>
                        <?php endif; ?>
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