<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Venta</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { border-radius: 12px; }
        .btn-add { margin-top: 32px; }
    </style>
</head>
<body>
<section class="container my-5">
    <h2 class="mb-4 text-primary fw-bold">Registrar Nueva Venta</h2>

    <form action="/dashboard/ventas/store" method="POST">
        <div class="row mb-4">
            <!-- Nombre del Cliente -->
            <div class="col-md-6">
                <label for="cliente" class="form-label">Nombre del Cliente</label>
                <input type="text" class="form-control" id="cliente" name="cliente" required>
            </div>

            <!-- Método de Pago -->
            <div class="col-md-6">
                <label for="metodo_pago" class="form-label">Método de Pago</label>
                <select class="form-select" id="metodo_pago" name="metodo_pago" required>
                    <option value="">Seleccione...</option>
                    <option value="Efectivo">Efectivo</option>
                    <option value="Tarjeta">Tarjeta</option>
                    <option value="QR">QR</option>
                </select>
            </div>
        </div>

<!-- Agregar Productos -->
<div class="card p-3 mb-4 shadow-sm">
        <h5 class="mb-3 fw-bold">Agregar Productos</h5>

    <!-- Barra de búsqueda y cantidad -->
    <div class="row mb-3">
        <div class="col-md-5">
            <label class="form-label">Buscar Producto</label>
            <input type="text" id="buscar-producto" class="form-control" placeholder="Ingrese nombre del producto...">
        </div>
        <div class="col-md-3">
            <label class="form-label">Cantidad</label>
            <input type="number" id="cantidad" class="form-control" min="1" value="1">
        </div>
    </div>

    <!-- Filtros -->
    <div class="row mb-3">
        <div class="col-md-4">
            <select id="filtro-categoria" class="form-select">
                <option value="">Filtrar por Categoría</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= htmlspecialchars($categoria['nombre']) ?>">
                        <?= htmlspecialchars($categoria['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <select id="filtro-presentacion" class="form-select">
                <option value="">Filtrar por Presentación</option>
                <?php foreach ($presentaciones as $presentacion): ?>
                    <option value="<?= htmlspecialchars($presentacion['nombre']) ?>">
                        <?= htmlspecialchars($presentacion['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <select id="filtro-marca" class="form-select">
                <option value="">Filtrar por Marca</option>
                <?php foreach ($marcas as $marca): ?>
                    <option value="<?= htmlspecialchars($marca['nombre']) ?>">
                        <?= htmlspecialchars($marca['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <!-- Tabla de resultados -->
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Presentación</th>
                    <th>Marca</th>
                    <th>Precio (S/.)</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody id="tabla-productos">
            </tbody>
        </table>
    </div>
</div>

        <!-- Tabla de Productos Agregados -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5 class="mb-3 fw-bold">Detalle de Venta</h5>
                <div class="table-responsive">
                    <table class="table table-striped" id="tabla-productos">
                        <thead class="table-primary">
                            <tr>
                                <th>Producto</th>
                                <th>Precio Unitario (S/.)</th>
                                <th>Cantidad</th>
                                <th>Subtotal (S/.)</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-detalle">

                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    <div class="text-end">
                        <p><strong>Subtotal: </strong>S/. <span id="subtotal">0.00</span></p>
                        <p><strong>Descuento: </strong>S/. <input type="number" id="descuento" name="descuento" value="0" class="form-control d-inline-block" style="width: 100px;"></p>
                        <p><strong>Total: </strong>S/. <span id="total">0.00</span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inputs ocultos para enviar los productos -->
        <input type="hidden" name="productos" id="productos-json">

        <!-- Botón Guardar -->
        <div class="text-end">
            <button type="submit" class="btn btn-primary btn-lg">Registrar Venta</button>
        </div>
    </form>
</section>


<script>
document.addEventListener("DOMContentLoaded", () => {
    const buscarInput = document.getElementById("buscar-producto");
    const filtroCategoria = document.getElementById("filtro-categoria");
    const filtroPresentacion = document.getElementById("filtro-presentacion");
    const filtroMarca = document.getElementById("filtro-marca");
    const tablaProductos = document.getElementById("tabla-productos");
    const tablaDetalleProductos = document.getElementById("tabla-detalle");
    const totalSpan = document.getElementById("total");
    const productos = <?php echo json_encode($productos); ?>;
    
    let detalle= [];

    function filtrarProductos() {
        const texto = buscarInput.value.toLowerCase();
        const cat = filtroCategoria.value.toLowerCase();
        const pres = filtroPresentacion.value.toLowerCase();
        const marca = filtroMarca.value.toLowerCase();
       
        const filtrados = productos.filter(p => {
            return (
                p.nombre.toLowerCase().includes(texto) &&
                (cat === "" || p.categoria.toLowerCase() === cat) &&
                (pres === "" || p.presentacion.toLowerCase() === pres) &&
                (marca === "" || p.marca.toLowerCase() === marca)
            );
        }).slice(0, 10); // Máximo 10 resultados

        tablaProductos.innerHTML = filtrados.map(p => `
            <tr>
                <td>${p.nombre}</td>
                <td>${p.categoria}</td>
                <td>${p.presentacion}</td>
                <td>${p.marca}</td>
                <td>${p.precio}</td>
                <td>
                    <button class="btn btn-primary btn-sm" onclick="agregarProducto(${p.id}, '${p.nombre}', ${p.precio})">
                        Agregar
                    </button>
                </td>
            </tr>
        `).join("");
    }

    buscarInput.addEventListener("input", filtrarProductos);
    filtroCategoria.addEventListener("change", filtrarProductos);
    filtroPresentacion.addEventListener("change", filtrarProductos);
    filtroMarca.addEventListener("change", filtrarProductos);

    window.eliminarProducto = (id) => {
        detalle = detalle.filter(p => p.id !== id);
        actualizarDetalle();
    };

    function actualizarDetalle(){
        tablaDetalleProductos.innerHTML = detalle.map(p=> `
            <tr>
                <td>${p.nombre}</td>
                <td>${p.precio}</td>
                <td>${p.cantidad}</td>
                <td>${(p.precio * p.cantidad).toFixed(2)}</td>
                <td>
                    <button class="btn btn-danger btn-sm" onclick="eliminarProducto(${p.id})">
                        Eliminar
                    </button>
                </td>
            </tr>
        `).join("");
    }

    window.agregarProducto = (id, nombre, precio) => {
        const cantidad = document.getElementById("cantidad").value;
        if (cantidad < 1) return;

        const existente = detalle.find(p=>p.id === id);
        if (existente) {
            existente.cantidad += cantidad;
        } else {
            detalle.push({id, nombre, precio, cantidad});
        }

        actualizarDetalle();
        buscarInput.innerHTML="";
        cantidad.innerHTML="";

    };
});
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>