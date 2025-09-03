<?php

require_once __DIR__ . '/../models/Inventario.php';

class InventarioController {
    private $model;

    public function __construct() {
        $this->model = new Inventario();
    }

    public function index() {
        $productos = $this->model->getAllProducts();
        require_once __DIR__ . '/../views/dashboard/inventario/index.php';
    }

    public function store(){
        
    }
}

?>