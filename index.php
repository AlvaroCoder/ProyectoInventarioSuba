<?php

require_once './app/core/Router.php';

use App\Core\Router;

$router = new Router();

$router->add('', function(){
    require_once './app/views/home/home.php';
});

$router->add('login', function(){
    require_once './app/views/auth/login.php';
});

$router->add('register', function(){
    require_once './app/views/auth/register.php';
});

$base_route_dashboard = "dashboard";

$router->add($base_route_dashboard, function(){
    require_once './app/controllers/BaseController.php';
    $contoller = new BaseController();
    return $contoller->index();
});

$router->add($base_route_dashboard . '/inventario',function(){
    require_once './app/controllers/InventarioController.php';
    $contoller = new InventarioController();
    return $contoller->index();
});

$router->add($base_route_dashboard . '/caja',function(){
    require_once './app/views/dashboard/caja/index.php';
});

$router->add($base_route_dashboard . "/ventas",function(){
    require_once './app/views/dashboard/ventas/index.php';
});

$router->add($base_route_dashboard . "/ventas/generar_boleta", function(){
    require_once './app/views/dashboard/ventas/generar_boleta.php';
});

$url = $_GET['url'] ?? '';
$router->dispatch($url);

?>