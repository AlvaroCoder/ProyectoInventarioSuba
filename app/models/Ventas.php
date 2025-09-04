<?php

class Ventas {
    private $db;

    public function __construct() {
        $this->db = Conexion::getInstance()->getConnection();
    }

    public function fetchAllVentas() {
        $sql = "SELECT * FROM ventas WHERE DATE(fecha) = CURDATE();";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCountAllVentasHoy(){
        $sql = "SELECT COUNT(*) AS ventas_hoy FROM ventas WHERE DATE(fecha) = CURDATE();";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getSumTotalVentasSemana(){
        $sql = "SELECT SUM(total) AS total_semana
                FROM ventas
                WHERE fecha >= DATE_SUB(CURDATE(), INTERVAL 7 DAY);";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);    
    }

    public function getTodasVentaDia() {
        $sql = "SELECT COUNT(*) AS total_ventas FROM ventas WHERE DATE(fecha) = CURDATE();";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getTotalVentasHoy() {
        $sql = "SELECT SUM(total) AS monto_total FROM ventas WHERE DATE(fecha) = CURDATE();";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertarVenta($cliente, $metodo_pago, $subtotal, $descuento, $total) {
        try {
            // Calcular IGV (asumiendo que el total incluye IGV)
            $igv = $total - ($total / 1.18);
    
            $sql = "INSERT INTO ventas (cliente_nombre, metodo_pago, subtotal, descuento, total, igv)
                    VALUES (:cliente, :metodo_pago, :subtotal, :descuento, :total, :igv)";
            $stmt = $this->db->prepare($sql);
    
            $stmt->bindParam(':cliente', $cliente);
            $stmt->bindParam(':metodo_pago', $metodo_pago);
            $stmt->bindParam(':subtotal', $subtotal);
            $stmt->bindParam(':descuento', $descuento);
            $stmt->bindParam(':total', $total);
            $stmt->bindParam(':igv', $igv);
    
            $stmt->execute();
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error al insertar venta: " . $e->getMessage());
            return false;
        }
    }
    
    public function insertarDetalleVenta($venta_id, $producto_id, $cantidad, $precio) {
        $sql = "INSERT INTO detalle_venta (idVenta, idProducto, cantidad, precio_unitario, subtotal)
                VALUES (:idVenta, :idProducto, :cantidad, :precio_unitario, :subtotal)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':idVenta', $venta_id);
        $stmt->bindParam(':idProducto', $producto_id);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':precio_unitario', $precio);
        $stmt->bindParam(':subtotal', $precio);
        $stmt->execute();
    }

    public function getVentaById($id) {
        $sql = "SELECT v.id, v.cliente, v.total, v.fecha_venta, 
                       p.nombre AS producto, dv.cantidad, dv.precio_unitario
                FROM ventas v
                INNER JOIN detalle_ventas dv ON v.id = dv.venta_id
                INNER JOIN productos p ON dv.producto_id = p.id
                WHERE v.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteVenta($id) {
        try {
            $this->db->beginTransaction();

            // Primero eliminar los detalles
            $sqlDetalle = "DELETE FROM detalle_ventas WHERE venta_id = :id";
            $stmtDetalle = $this->db->prepare($sqlDetalle);
            $stmtDetalle->bindParam(':id', $id);
            $stmtDetalle->execute();

            // Luego eliminar la venta
            $sqlVenta = "DELETE FROM ventas WHERE id = :id";
            $stmtVenta = $this->db->prepare($sqlVenta);
            $stmtVenta->bindParam(':id', $id);
            $stmtVenta->execute();

            $this->db->commit();
            return true;

        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
}

?>