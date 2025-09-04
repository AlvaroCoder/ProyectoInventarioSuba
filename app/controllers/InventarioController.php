<?php

require_once __DIR__ . '/../models/Inventario.php';

class InventarioController {
    private $model;

    public function __construct() {
        $this->model = new Inventario();
    }

    // Vista principal del inventario
    public function index() {
        // Parámetros GET
        $nombre = isset($_GET['nombre']) ? trim($_GET['nombre']) : '';
        $idCategoria = isset($_GET['idCategoria']) ? intval($_GET['idCategoria']) : null;
        $idMarca = isset($_GET['idMarca']) ? intval($_GET['idMarca']) : null;
        $idPresentacion = isset($_GET['idPresentacion']) ? intval($_GET['idPresentacion']) : null;

        // Obtener datos filtrados
        $productos = $this->model->getFilteredProducts($nombre, $idCategoria, $idMarca, $idPresentacion);

        // KPIs
        $totalProductos = $this->model->getCountProducts();
        $precioTotal = $this->model->getSumProducts();
        $productosActivos = $this->model->getCountActiveProducts();

        // Datos para los selects
        $categorias = $this->model->getCategorias();
        $marcas = $this->model->getMarcas();
        $presentaciones = $this->model->getPresentaciones();

        require_once __DIR__ . '/../views/dashboard/inventario/index.php';
    }

    // Mostrar formulario para crear un nuevo producto
    public function create() {
        $categorias = $this->model->getCategorias();
        $marcas = $this->model->getMarcas();
        $presentaciones = $this->model->getPresentaciones();
        require_once __DIR__ . '/../views/dashboard/inventario/create.php';
    }

    // Guardar un nuevo producto
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $cantidad = $_POST['cantidad'];
            $precio = $_POST['precio'];

            if ($this->model->insert($nombre, $cantidad, $precio)) {
                header("Location: /inventario");
                exit;
            } else {
                echo "Error al agregar el producto.";
            }
        }
    }

    // Mostrar formulario para editar un producto
    public function edit($id) {
        $producto = $this->model->getProductById($id);
        $categorias = $this->model->getCategorias();
        $marcas = $this->model->getMarcas();
        $presentaciones = $this->model->getPresentaciones();
        require_once __DIR__ . '/../views/dashboard/inventario/edit.php';
    }

    // Actualizar producto
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $cantidad = $_POST['cantidad'];
            $precio = $_POST['precio'];
            $idCategoria = $_POST['idCategoria'];
            $idMarca = $_POST['idMarca'];
            $idPresentacion = $_POST['idPresentacion'];

            if ($this->model->update($id, $nombre, $descripcion, $cantidad, $precio, $idCategoria, $idMarca, $idPresentacion)) {
                header("Location: /inventario");
                exit;
            } else {
                echo "Error al actualizar el producto.";
            }
        }
    }

    // Eliminar producto
    public function delete($id) {
        if ($this->model->delete($id)) {
            header("Location: /inventario");
            exit;
        } else {
            echo "Error al eliminar el producto.";
        }
    }

    // Vista de categorías
    public function categorias() {
        $categorias = $this->model->getAllCategorias();
        require_once __DIR__ . '/../views/dashboard/inventario/categorias.php';
    }

    // Vista de marcas
    public function marcas() {
        $marcas = $this->model->getAllMarcas();
        require_once __DIR__ . '/../views/dashboard/inventario/marcas.php';
    }

    // Vista de presentaciones
    public function presentaciones() {
        $presentaciones = $this->model->getAllPresentaciones();
        require_once __DIR__ . '/../views/dashboard/inventario/presentaciones.php';
    }
}

?>