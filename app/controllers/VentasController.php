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

    // ✅ Muestra todas las ventas del día
    public function index() {
        $ventas = $this->ventasModel->fetchAllVentas();
        $totalVentasDias = $this->ventasModel->getTodasVentaDia();
        $numeroVentasHoy = $this->ventasModel->getCountAllVentasHoy();
        $numeroTransacciones = isset($numeroVentasHoy['ventas_hoy']);
        $montoTotal = $this->ventasModel->getTotalVentasHoy();
        $ingresosSemana = $this->ventasModel->getSumTotalVentasSemana();
        $ticketPromedio = isset($montoTotal['total_ventas']) / isset($numeroVentasHoy['ventas_hoy']);
        // Cuando tengas la vista:
        include __DIR__ . '/../views/dashboard/ventas/index.php';

    }

    // ✅ Muestra el formulario para crear una venta (usará las vistas)
    public function create() {
        // Obtenemos productos disponibles desde Inventario
        $productos = $this->inventarioModel->getAllProducts();
        $categorias = $this->inventarioModel->getCategorias();
        $marcas = $this->inventarioModel->getMarcas();
        $presentaciones = $this->inventarioModel->getPresentaciones();

        include __DIR__ . '/../views/dashboard/ventas/create.php';
    }

    // ✅ Procesa la creación de una nueva venta
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cliente = $_POST['cliente'] ?? 'Cliente Genérico';
            $total = $_POST['total'] ?? 0;

            // Esperamos que los productos lleguen como JSON
            $productos = json_decode($_POST['productos'], true);

            if (!is_array($productos) || empty($productos)) {
                echo json_encode(['error' => 'No se enviaron productos']);
                return;
            }

            try {
                $ventaId = $this->ventasModel->insertVenta($cliente, $total, $productos);
                echo json_encode(['success' => true, 'venta_id' => $ventaId]);
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
        } else {
            echo json_encode(['error' => 'Método no permitido']);
        }
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