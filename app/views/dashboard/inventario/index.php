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
        body { background-color: #f8f9fa; }
        .kpi-card { border-radius: 12px; transition: transform 0.2s ease; }
        .kpi-card:hover { transform: translateY(-5px); box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .progress { height: 12px; border-radius: 8px; }
        .sidebar { background: linear-gradient(180deg, #0d6efd, #0b5ed7); color: #fff; height: 100vh; position: fixed; width: 250px; }
        .sidebar .nav-link { color: #fff; font-weight: 500; }
        .sidebar .nav-link.active { background: rgba(255,255,255,0.2); border-radius: 8px; }
        .main-content { margin-left: 250px; padding: 20px; }
        @media(max-width: 768px) { .main-content { margin-left: 0; } }
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
                    <h3 class="fw-bold text-primary"><?= htmlspecialchars($totalProductos['total']) ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Stock Bajo</h6>
                    <h3 class="fw-bold text-danger">0</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Valor Inventario</h6>
                    <h3 class="fw-bold text-success">
                       S/. <?= htmlspecialchars($precioTotal['precioTotal']) ?>
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Productos Activos</h6>
                    <h3 class="fw-bold text-info"><?= htmlspecialchars($productosActivos['productosActivos']) ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Barra de búsqueda y filtros -->
    <div class="card p-3 mb-4 shadow-sm">
        <div class="row g-3 align-items-center">
            <div class="col-md-4">
                <input type="text" id="search" class="form-control" placeholder="Buscar por nombre...">
            </div>
            <div class="col-md-3">
                <select id="categoria" class="form-select">
                    <option value="">Filtrar por Categoría</option>
                    <?php foreach($categorias as $categoria): ?>
                        <option value="<?= htmlspecialchars($categoria['nombre']) ?>">
                        <?= htmlspecialchars($categoria['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <select id="marca" class="form-select">
                    <option value="">Filtrar por Marca</option>
                    <?php foreach($marcas as $marca): ?>
                        <option value="<?= htmlspecialchars($marca['nombre']) ?>">
                        <?= htmlspecialchars($marca['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <select id="presentacion" class="form-select">
                    <option value="">Filtrar por Presentación</option>
                    <?php foreach($presentaciones as $presentacion): ?>
                        <option value="<?= htmlspecialchars($presentacion['nombre']) ?>">
                        <?= htmlspecialchars($presentacion['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Categoría -->
        </div>
    </div>

    <!-- Tabla de Inventario -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex flex-row justify-content-between my-4 align-items-center">
                <h5 class="mb-3 fw-bold">Lista de Productos</h5>
                <button type="button" class="btn btn-primary">
                    <a 
                    class="text-white text-decoration-none"
                    href="/index.php?url=dashboard/inventario/create">Agregar Productos</a>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle" id="productos-table">
                    <thead class="table-primary">
                        <tr>
                            <th>Código</th>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>Marca</th>
                            <th>Presentación</th>
                            <th>Stock</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="productos-tbody">
                        <?php if(!empty($productos)): ?>
                            <?php foreach($productos as $producto): ?>
                            <tr>
                                <td><?= htmlspecialchars($producto['id'])?></td>
                                <td><?= htmlspecialchars($producto['nombre'])?></td>
                                <td><?= htmlspecialchars($producto['categoria'])?></td>
                                <td><?= htmlspecialchars($producto['marca']) ?></td>
                                <td><?= htmlspecialchars($producto['presentacion']) ?></td>
                                <td><?= htmlspecialchars($producto['cantidad'])?></td>
                                <td>S/.<?= htmlspecialchars($producto['precio'])?></td>
                                <td>
                                <button class="btn btn-sm btn-primary">Editar</button>
                                <button class="btn btn-sm btn-danger">Eliminar</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>  
                        <?php else: ?>
                            <tr>
                            <td colspan="8" class="text-center text-muted">No hay productos registrados</td>
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

<!-- Filtro dinámico con JS -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  // 1) Datos del servidor -> JS (array completo de productos ya cargado)
  window.PRODUCTOS = <?= json_encode($productos, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) ?>;

  const $search = document.getElementById('search');
  const $categoria = document.getElementById('categoria');
  const $marca = document.getElementById('marca');
  const $presentacion = document.getElementById('presentacion');
  const $tbody = document.getElementById('productos-tbody');

  // util: quitar acentos y pasar a minúsculas
  const norm = (s) => (s || '')
    .toString()
    .normalize('NFD').replace(/[\u0300-\u036f]/g,'')
    .toLowerCase()
    .trim();

  function renderTable(rows) {
    if (!rows.length) {
      $tbody.innerHTML = `
        <tr>
          <td colspan="8" class="text-center text-muted">No se encontraron productos</td>
        </tr>`;
      return;
    }

    const html = rows.map(p => `
      <tr>
        <td>${escapeHtml(p.id)}</td>
        <td>${escapeHtml(p.nombre)}</td>
        <td>${escapeHtml(p.categoria ?? '')}</td>
        <td>${escapeHtml(p.marca ?? '')}</td>
        <td>${escapeHtml(p.presentacion ?? '')}</td>
        <td>${escapeHtml(p.cantidad)}</td>
        <td>S/.${escapeHtml(p.precio)}</td>
        <td>
          <button class="btn btn-sm btn-primary">Editar</button>
          <button class="btn btn-sm btn-danger">Eliminar</button>
        </td>
      </tr>`).join('');
    $tbody.innerHTML = html;
  }

  function escapeHtml(v) {
    return String(v)
      .replaceAll('&','&amp;')
      .replaceAll('<','&lt;')
      .replaceAll('>','&gt;')
      .replaceAll('"','&quot;')
      .replaceAll("'","&#039;");
  }

  function filtrarProductos() {
    const q = norm($search.value);
    const cat = $categoria.value;      // nombre (no id)
    const mar = $marca.value;          // nombre (no id)
    const pre = $presentacion.value;   // nombre (no id)

    const filtrados = window.PRODUCTOS.filter(p => {
      const byName = q ? norm(p.nombre).includes(q) : true;
      const byCat  = cat ? (p.categoria === cat) : true;
      const byMar  = mar ? (p.marca === mar) : true;
      const byPre  = pre ? (p.presentacion === pre) : true;
      return byName && byCat && byMar && byPre;
    });

    renderTable(filtrados);
  }

  // 2) Listeners "tipo onChange" (en tiempo real)
  $search.addEventListener('input', filtrarProductos);
  $categoria.addEventListener('change', filtrarProductos);
  $marca.addEventListener('change', filtrarProductos);
  $presentacion.addEventListener('change', filtrarProductos);

  // 3) Render inicial
  renderTable(window.PRODUCTOS);
});
</script>
</body>
</html>