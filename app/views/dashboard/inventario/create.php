<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white text-center py-3">
            <h3 class="mb-0">Agregar Nuevo Producto</h3>
        </div>
        <div class="card-body p-4">
            <form action="/index.php?url=dashboard/inventario/store" method="POST">
                
                <!-- Nombre del producto -->
                <div class="mb-3">
                    <label for="nombre" class="form-label fw-bold">Nombre del Producto</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ej. Shampoo para perros" required>
                </div>

                <!-- Categoría -->
                <div class="mb-3">
                    <label for="categoria" class="form-label fw-bold">Categoría</label>
                    <select name="categoria" id="categoria" class="form-select" required>
                        <option value="">Seleccione una Categoría</option>
                        <?php foreach($categorias as $categoria): ?>
                            <option value="<?= htmlspecialchars($categoria['idCategoria']) ?>">
                                <?= htmlspecialchars($categoria['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Marca -->
                <div class="mb-3">
                    <label for="marca" class="form-label fw-bold">Marca</label>
                    <select name="marca" id="marca" class="form-select" required>
                        <option value="">Seleccione una Marca</option>
                        <?php foreach($marcas as $marca): ?>
                            <option value="<?= htmlspecialchars($marca['idMarca']) ?>">
                                <?= htmlspecialchars($marca['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Presentación -->
                <div class="mb-3">
                    <label for="presentacion" class="form-label fw-bold">Presentación</label>
                    <select name="presentacion" id="presentacion" class="form-select" required>
                        <option value="">Seleccione una Presentación</option>
                        <?php foreach($presentaciones as $presentacion): ?>
                            <option value="<?= htmlspecialchars($presentacion['idPresentacion']) ?>">
                                <?= htmlspecialchars($presentacion['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Stock -->
                <div class="mb-3">
                    <label for="cantidad" class="form-label fw-bold">Cantidad en Stock</label>
                    <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Ej. 50" required>
                </div>

                <!-- Precio -->
                <div class="mb-3">
                    <label for="precio" class="form-label fw-bold">Precio (S/.)</label>
                    <input type="number" step="0.01" name="precio" id="precio" class="form-control" placeholder="Ej. 25.90" required>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-between">
                    <a href="/index.php?url=dashboard/inventario" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Producto</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>