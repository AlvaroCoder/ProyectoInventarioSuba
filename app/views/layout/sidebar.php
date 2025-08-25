<!-- Botón para abrir el sidebar en móviles -->
<nav class="navbar navbar-light bg-light d-md-none">
    <div class="container-fluid">
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
            ☰ Menú
        </button>
    </div>
</nav>

<!-- Sidebar fijo en pantallas grandes -->
<div class="d-none d-md-flex flex-column flex-shrink-0 p-3 bg-primary text-white" style="width: 250px; height: 100vh; position: fixed;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4 fw-bold">Minimarket SUBA</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item mb-2">
            <a href="/index.php?url=dashboard" class="nav-link text-white d-flex align-items-center">
                <i data-lucide="layout-dashboard" class="me-2"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="/index.php?url=dashboard/inventario" class="nav-link text-white d-flex align-items-center">
                <i data-lucide="package" class="me-2"></i>
                Inventario
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="/caja" class="nav-link text-white d-flex align-items-center">
                <i data-lucide="credit-card" class="me-2"></i>
                Caja
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://via.placeholder.com/40" alt="User" width="32" height="32" class="rounded-circle me-2">
            <strong>Usuario</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser">
            <li><a class="dropdown-item" href="#">Perfil</a></li>
            <li><a class="dropdown-item" href="#">Configuración</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/logout">Cerrar Sesión</a></li>
        </ul>
    </div>
</div>

<!-- Sidebar en versión Offcanvas para móviles -->
<div class="offcanvas offcanvas-start bg-primary text-white" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel" style="width: 250px;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title fw-bold" id="offcanvasSidebarLabel">Menú</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item mb-2">
                <a href="/homeDashboard" class="nav-link text-white d-flex align-items-center">
                    <i data-lucide="layout-dashboard" class="me-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="/inventario" class="nav-link text-white d-flex align-items-center">
                    <i data-lucide="package" class="me-2"></i>
                    Inventario
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="/caja" class="nav-link text-white d-flex align-items-center">
                    <i data-lucide="credit-card" class="me-2"></i>
                    Caja
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- Script para lucide icons -->
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>