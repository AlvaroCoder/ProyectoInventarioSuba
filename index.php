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

$router->add('dashboard', function(){
    require_once './app/views/home/homeDashboard.php';
});

$url = $_GET['url'] ?? '';
$router->dispatch($url);

?>