<?php 

require_once __DIR__ . '/../models/Ventas.php';
require_once __DIR__ . '/../models/Inventario.php';

class VentasController {
    private $ventasModel;
    private $inventarioModel;

    public function __construct() {
        $this->ventasModel = new Ventas();
        $this->inventarioModel = new Inventario();
    }

    public function index() {
        $ventas = $this->ventasModel->fetchAllVentas();
        $numeroVentasHoy = $this->ventasModel->getCountAllVentasHoy();
        $numeroTransacciones = $numeroVentasHoy['ventas_hoy'] ?? 0;
        $montoTotal = $this->ventasModel->getTotalVentasHoy();
        $ingresosSemana = $this->ventasModel->getSumTotalVentasSemana();
        $ticketPromedio = ($numeroTransacciones > 0) ? ( $montoTotal['monto_total'] ?? 1) / $numeroTransacciones : 0;
        include __DIR__ . '/../views/dashboard/ventas/index.php';

    }

    public function create() {
        $productos = $this->inventarioModel->getAllProducts();
        $categorias = $this->inventarioModel->getCategorias();
        $marcas = $this->inventarioModel->getMarcas();
        $presentaciones = $this->inventarioModel->getPresentaciones();

        include __DIR__ . '/../views/dashboard/ventas/create.php';
    }

    public function store() {
        // Capturar datos del formulario
        $cliente = $_POST['cliente'] ?? '';
        $metodo_pago = $_POST['metodo_pago'] ?? '';
        $descuento = floatval($_POST['descuento'] ?? 0);
    
        // Capturar productos en formato JSON y convertir a array
        $productos_json = $_POST['productos'] ?? '[]';
        $productos = json_decode($productos_json, true);
    
        // Validar datos mínimos
        if (empty($cliente) || empty($metodo_pago) || empty($productos)) {
            die("Datos incompletos");
        }
    
        // Calcular subtotal y total
        $subtotal = 0;
        foreach ($productos as $p) {
            $subtotal += $p['precio'] * $p['cantidad'];
        }
        $total = $subtotal - $descuento;
    
        // Guardar venta en la base de datos
        $venta_id = $this->ventasModel->insertarVenta(
            $cliente, 
            $metodo_pago, 
            $subtotal, 
            $descuento, 
            $total);
        
        // Guardar detalles de la venta
        foreach ($productos as $p) {
            $this->ventasModel->insertarDetalleVenta($venta_id, $p['id'], $p['cantidad'], $p['precio']);
            $this->inventarioModel->updateStock($p['id'], $p['cantidad']);
        }
    
        // Redirigir o mostrar mensaje
        header("Location: /index.php?url=/dashboard/ventas");
    }

    // ✅ Muestra el detalle de una venta específica
    public function show($id) {
        $detalle = $this->ventasModel->getVentaById($id);

        // Cuando tengas la vista:
        // include __DIR__ . '/../views/ventas/show.php';

        echo json_encode($detalle);
    }

    // ✅ Elimina una venta
    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->ventasModel->deleteVenta($id);
                echo json_encode(['success' => true]);
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
        } else {
            echo json_encode(['error' => 'Método no permitido']);
        }
    }
}

?>