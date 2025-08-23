<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Minimarket SUBA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .hero-section {
            background: linear-gradient(to right, #007bff, #6610f2);
            color: white;
            padding: 80px 20px;
            text-align: center;
            border-radius: 0 0 40px 40px;
        }
        .hero-section h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .feature-card {
            transition: transform 0.3s ease-in-out;
        }
        .feature-card:hover {
            transform: translateY(-10px);
        }
        footer {
            background: #343a40;
            color: white;
            padding: 15px 0;
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>

    <!-- Sección Hero -->
    <div class="hero-section">
        <h1>Bienvenido a Minimarket SUBA</h1>
        <p class="lead">Tu solución segura y confiable para la gestión de tu negocio</p>
        <a href="login" class="btn btn-light btn-lg mt-3">Iniciar Sesión</a>
        <a href="register" class="btn btn-outline-light btn-lg mt-3">Registrarse</a>
    </div>

    <!-- Sección de características -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">¿Por qué elegir nuestro software?</h2>
        <div class="row g-4">
            <!-- Seguridad -->
            <div class="col-md-4">
                <div class="card feature-card shadow-sm h-100">
                    <div class="card-body text-center">
                        <img src="https://img.icons8.com/ios-filled/100/007bff/security-checked.png" alt="Seguridad" class="mb-3">
                        <h5 class="card-title">Seguridad Total</h5>
                        <p class="card-text">Protege la información de tu negocio con un sistema seguro y confiable.</p>
                    </div>
                </div>
            </div>
            <!-- Gestión de Inventario -->
            <div class="col-md-4">
    <div class="card feature-card shadow-sm h-100">
        <div class="card-body text-center">
            <!-- Ícono Lucide -->
            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="mb-3 text-primary" 
                 width="64" height="64" 
                 viewBox="0 0 24 24" 
                 fill="none" 
                 stroke="currentColor" 
                 stroke-width="2" 
                 stroke-linecap="round" 
                 stroke-linejoin="round">
                <path d="M16.5 9.4L7.5 4.21"></path>
                <path d="M21 16V8a2 2 0 0 0-1-1.73L13 2.27a2 2 0 0 0-2 0L4 6.27A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4a2 2 0 0 0 1-1.73z"></path>
                <path d="M3.27 6.96L12 12l8.73-5.04"></path>
                <path d="M12 22V12"></path>
            </svg>

            <h5 class="card-title">Gestión de Inventario</h5>
            <p class="card-text">Administra tus productos, controla el stock y recibe alertas cuando falte mercadería.</p>
        </div>
    </div>
</div>
            <!-- Gestión de Caja -->
            <div class="col-md-4">
                <div class="card feature-card shadow-sm h-100">
                    <div class="card-body text-center">
                        <img src="https://img.icons8.com/ios-filled/100/007bff/cash-register.png" alt="Caja" class="mb-3">
                        <h5 class="card-title">Gestión de Caja</h5>
                        <p class="card-text">Controla tus ingresos, egresos y mantén tu negocio siempre ordenado.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Segunda fila de características -->
        <div class="row g-4 mt-3">
            <!-- Reportes -->
            <div class="col-md-6">
                <div class="card feature-card shadow-sm h-100">
                    <div class="card-body text-center">
                        <img src="https://img.icons8.com/ios-filled/100/007bff/combo-chart.png" alt="Reportes" class="mb-3">
                        <h5 class="card-title">Reportes Detallados</h5>
                        <p class="card-text">Genera reportes en tiempo real para tomar decisiones inteligentes.</p>
                    </div>
                </div>
            </div>
            <!-- Alertas -->
            <div class="col-md-6">
                <div class="card feature-card shadow-sm h-100">
                    <div class="card-body text-center">
                        <img src="https://img.icons8.com/ios-filled/100/007bff/alarm.png" alt="Alertas" class="mb-3">
                        <h5 class="card-title">Alertas Inteligentes</h5>
                        <p class="card-text">Recibe notificaciones sobre inventario bajo y movimientos importantes.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Minimarket SUBA - Todos los derechos reservados</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>