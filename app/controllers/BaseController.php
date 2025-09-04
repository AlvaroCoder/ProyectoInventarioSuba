<?php

require_once __DIR__ . '/../models/Inventario.php';


class BaseController{
    private $modelInventario;
    public function __construct(){
        $this->modelInventario = new Inventario();
    }   

    public function index(){
        $productosBajoStock = $this->modelInventario->getCountInactiveProducts();
        $resumenProductos=$this->modelInventario->get10FirstProducts();
        require_once __DIR__ . '/../views/dashboard/index.php';
    }
}

?>
