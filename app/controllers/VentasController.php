<?php 

require_once __DIR__ . '/../models/Inventario.php';

class VentasController{
    private $modelInventario;

    public function __construct(){
        $this->modelInventario = new Inventario();
        
    }
}

?>