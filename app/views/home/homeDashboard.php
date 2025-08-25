<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Minimarket SUBA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
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
<body>

<?php require_once __DIR__ . '/../layout/sidebar.php' ?>

<div class="main-content">
    <div class="container-fluid">
        <h2 class="fw-bold text-primary mb-3">Panel de Control</h2>
        <p class="text-muted mb-4">Bienvenido al dashboard principal. Aquí puedes visualizar el resumen general.</p>

        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card kpi-card shadow-sm text-center p-3">
                    <i data-lucide="alert-triangle" class="text-danger mb-2" style="width: 32px; height: 32px;"></i>
                    <h6 class="text-muted">Productos con Bajo Stock</h6>
                    <h3 class="text-danger fw-bold">12</h3>
                    <small class="text-muted">Última actualización: Hoy</small>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card kpi-card shadow-sm text-center p-3">
                    <i data-lucide="package-plus" class="text-success mb-2" style="width: 32px; height: 32px;"></i>
                    <h6 class="text-muted">Último Producto Ingresado</h6>
                    <h4 class="text-success fw-bold">Laptop Dell</h4>
                    <small class="text-muted">Ingresado hace 2 horas</small>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card kpi-card shadow-sm text-center p-3">
                    <i data-lucide="shopping-bag" class="text-primary mb-2" style="width: 32px; height: 32px;"></i>
                    <h6 class="text-muted">Producto Más Vendido</h6>
                    <h4 class="text-primary fw-bold">Mouse Logitech</h4>
                    <small class="text-muted">Total Vendidos: 250</small>
                </div>
            </div>
        </div>

        <!-- Tabla -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Resumen de Productos</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>Stock</th>
                            <th>Precio</th>
                            <th>Última Venta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Laptop Dell</td>
                            <td>Electrónica</td>
                            <td><span class="badge bg-danger">8</span></td>
                            <td>S/ 3,500</td>
                            <td>Hoy</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Mouse Logitech</td>
                            <td>Accesorios</td>
                            <td><span class="badge bg-success">25</span></td>
                            <td>S/ 150</td>
                            <td>Ayer</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Teclado Mecánico</td>
                            <td>Accesorios</td>
                            <td><span class="badge bg-warning text-dark">10</span></td>
                            <td>S/ 280</td>
                            <td>Hace 2 días</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Ingresos / Egresos -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Ingresos de Caja</h5>
                    </div>
                    <div class="card-body">
                        <h3 class="fw-bold text-success">S/ 12,500</h3>
                        <small class="text-muted">Última actualización: Hoy</small>
                        <div class="progress mt-3">
                            <div class="progress-bar bg-success" style="width: 75%;">75%</div>
                        </div>
                        <p class="mt-2 text-muted">Meta: S/ 15,000</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">Egresos de Caja</h5>
                    </div>
                    <div class="card-body">
                        <h3 class="fw-bold text-danger">S/ 4,200</h3>
                        <small class="text-muted">Última actualización: Hoy</small>
                        <div class="progress mt-3">
                            <div class="progress-bar bg-danger" style="width: 35%;">35%</div>
                        </div>
                        <p class="mt-2 text-muted">Límite: S/ 12,000</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    lucide.createIcons();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>