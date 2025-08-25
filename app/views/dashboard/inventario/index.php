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
<div class="container my-4">
    <h2 class="mb-4 text-primary fw-bold">Inventario de Productos</h2>

    <!-- KPIs -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total Productos</h6>
                    <h3 class="fw-bold text-primary">1,250</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Stock Bajo</h6>
                    <h3 class="fw-bold text-danger">45</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Valor Inventario</h6>
                    <h3 class="fw-bold text-success">S/ 85,000</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Productos Activos</h6>
                    <h3 class="fw-bold text-info">1,180</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Barra de búsqueda y filtros -->
    <div class="card p-3 mb-4 shadow-sm">
        <div class="row g-3 align-items-center">
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Buscar por nombre o código...">
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option value="">Filtrar por Categoría</option>
                    <option>Medicamentos</option>
                    <option>Accesorios</option>
                    <option>Alimentos</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option value="">Filtrar por Proveedor</option>
                    <option>Proveedor A</option>
                    <option>Proveedor B</option>
                    <option>Proveedor C</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select">
                    <option value="">Estado</option>
                    <option>Activo</option>
                    <option>Inactivo</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Tabla de Inventario -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3 fw-bold">Lista de Productos</h5>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>Código</th>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>Stock</th>
                            <th>Precio</th>
                            <th>Proveedor</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>PRD001</td>
                            <td>Alimento Premium</td>
                            <td>Alimentos</td>
                            <td>50</td>
                            <td>S/ 45.00</td>
                            <td>Proveedor A</td>
                            <td><span class="badge bg-success">Activo</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">Editar</button>
                                <button class="btn btn-sm btn-danger">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <td>PRD002</td>
                            <td>Collar Ajustable</td>
                            <td>Accesorios</td>
                            <td>20</td>
                            <td>S/ 30.00</td>
                            <td>Proveedor B</td>
                            <td><span class="badge bg-warning text-dark">Stock Bajo</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">Editar</button>
                                <button class="btn btn-sm btn-danger">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <td>PRD003</td>
                            <td>Vacuna Antirrábica</td>
                            <td>Medicamentos</td>
                            <td>120</td>
                            <td>S/ 80.00</td>
                            <td>Proveedor C</td>
                            <td><span class="badge bg-success">Activo</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">Editar</button>
                                <button class="btn btn-sm btn-danger">Eliminar</button>
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