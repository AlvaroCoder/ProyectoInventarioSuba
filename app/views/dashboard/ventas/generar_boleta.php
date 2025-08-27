<!-- app/views/dashboard/ventas/generar_boleta.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Boleta de Venta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .card {
            border-radius: 12px;
        }
        .product-summary {
            max-height: 500px;
            overflow-y: auto;
        }
        .total-section {
            font-size: 1.1rem;
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
    <h2 class="mb-4 text-primary fw-bold">Generar Boleta de Venta</h2>

    <div class="row g-4">
        <!-- Formulario -->
        <div class="col-lg-7">
            <div class="card shadow-sm p-4">
                <h5 class="mb-3 fw-bold text-secondary">Datos del Cliente</h5>
                <div class="mb-3">
                    <label class="form-label">Nombre del Cliente</label>
                    <input type="text" class="form-control" placeholder="Ingrese nombre completo" id="cliente_nombre">
                </div>
                <div class="mb-4">
                    <label class="form-label">DNI</label>
                    <input type="text" class="form-control" placeholder="Ingrese DNI" id="cliente_dni" maxlength="8">
                </div>

                <h5 class="mb-3 fw-bold text-secondary">Agregar Productos</h5>
                <div class="row g-3 align-items-end mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Producto</label>
                        <select class="form-select" id="producto_select">
                            <option value="">Seleccione un producto</option>
                            <option value="1" data-precio="50">Teclado - S/ 50.00</option>
                            <option value="2" data-precio="120">Mouse - S/ 120.00</option>
                            <option value="3" data-precio="80">Audífonos - S/ 80.00</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Cantidad</label>
                        <input type="number" class="form-control" min="1" value="1" id="producto_cantidad">
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-success w-100" id="agregar_producto">Agregar</button>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descuento (%)</label>
                    <input type="number" class="form-control" id="descuento" placeholder="Ej: 10" min="0" max="100">
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="index.php?controller=Ventas&action=index" class="btn btn-secondary btn-lg">Cancelar</a>
                    <button class="btn btn-primary btn-lg" id="generar_boleta">Generar Boleta</button>
                </div>
            </div>
        </div>

        <!-- Resumen -->
        <div class="col-lg-5">
            <div class="card shadow-sm p-4">
                <h5 class="mb-3 fw-bold text-secondary">Resumen de Venta</h5>
                <div class="product-summary mb-3" id="resumen_productos">
                    <p class="text-muted">No se han agregado productos.</p>
                </div>
                <hr>
                <div class="total-section">
                    <p><strong>Subtotal:</strong> S/ <span id="subtotal">0.00</span></p>
                    <p><strong>IGV (18%):</strong> S/ <span id="igv">0.00</span></p>
                    <p><strong>Descuento:</strong> S/ <span id="descuento_aplicado">0.00</span></p>
                    <h4 class="text-primary fw-bold">Total: S/ <span id="total">0.00</span></h4>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const productos = [];
    const resumenProductos = document.getElementById('resumen_productos');
    const subtotalEl = document.getElementById('subtotal');
    const igvEl = document.getElementById('igv');
    const totalEl = document.getElementById('total');
    const descuentoAplicadoEl = document.getElementById('descuento_aplicado');

    document.getElementById('agregar_producto').addEventListener('click', function(e) {
        e.preventDefault();
        const select = document.getElementById('producto_select');
        const cantidad = parseInt(document.getElementById('producto_cantidad').value);
        const descuento = parseFloat(document.getElementById('descuento').value) || 0;

        if (!select.value || cantidad < 1) {
            alert('Seleccione un producto y cantidad válida');
            return;
        }

        const nombre = select.options[select.selectedIndex].text;
        const precio = parseFloat(select.options[select.selectedIndex].dataset.precio);

        productos.push({ nombre, cantidad, precio });
        actualizarResumen(descuento);
    });

    function actualizarResumen(descuento) {
        resumenProductos.innerHTML = '';
        let subtotal = 0;

        productos.forEach((prod, index) => {
            const itemSubtotal = prod.precio * prod.cantidad;
            subtotal += itemSubtotal;
            resumenProductos.innerHTML += `
                <div class="d-flex justify-content-between border-bottom py-2">
                    <div>
                        <strong>${prod.nombre}</strong><br>
                        <small>Cant: ${prod.cantidad} | Unit: S/ ${prod.precio.toFixed(2)}</small>
                    </div>
                    <div><strong>S/ ${(itemSubtotal).toFixed(2)}</strong></div>
                </div>
            `;
        });

        const igv = subtotal * 0.18;
        const descuentoAplicado = (subtotal + igv) * (descuento / 100);
        const total = subtotal + igv - descuentoAplicado;

        subtotalEl.textContent = subtotal.toFixed(2);
        igvEl.textContent = igv.toFixed(2);
        descuentoAplicadoEl.textContent = descuentoAplicado.toFixed(2);
        totalEl.textContent = total.toFixed(2);
    }

    document.getElementById('generar_boleta').addEventListener('click', function() {
        if (productos.length === 0) {
            alert('Agregue al menos un producto antes de generar la boleta');
            return;
        }
        alert('Boleta generada con éxito');
        // Aquí puedes enviar los datos al backend usando fetch o un formulario oculto
    });
</script>
</body>
</html>