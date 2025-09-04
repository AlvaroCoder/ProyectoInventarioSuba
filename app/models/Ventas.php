<?php

class Ventas {
    private $db;

    public function __construct() {
        $this->db = Conexion::getInstance()->getConnection();
    }

    public function fetchAllVentas() {
        $sql = "SELECT * FROM ventas WHERE DATE(fecha_venta) = CURDATE();";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTodasVentaDia() {
        $sql = "SELECT COUNT(*) AS total_ventas FROM ventas WHERE DATE(fecha_venta) = CURDATE();";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getTotalVentas() {
        $sql = "SELECT SUM(total) AS monto_total FROM ventas WHERE DATE(fecha_venta) = CURDATE();";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertVenta($cliente, $total, $productos) {
        try {
            $this->db->beginTransaction();

            // Insertar la venta
            $sqlVenta = "INSERT INTO ventas (cliente, total, fecha_venta) VALUES (:cliente, :total, NOW())";
            $stmt = $this->db->prepare($sqlVenta);
            $stmt->bindParam(':cliente', $cliente);
            $stmt->bindParam(':total', $total);
            $stmt->execute();

            $ventaId = $this->db->lastInsertId();

            // Insertar los productos en detalle_ventas
            $sqlDetalle = "INSERT INTO detalle_ventas (venta_id, producto_id, cantidad, precio_unitario) 
                           VALUES (:venta_id, :producto_id, :cantidad, :precio_unitario)";
            $stmtDetalle = $this->db->prepare($sqlDetalle);

            foreach ($productos as $producto) {
                $stmtDetalle->bindParam(':venta_id', $ventaId);
                $stmtDetalle->bindParam(':producto_id', $producto['id']);
                $stmtDetalle->bindParam(':cantidad', $producto['cantidad']);
                $stmtDetalle->bindParam(':precio_unitario', $producto['precio']);
                $stmtDetalle->execute();
            }

            $this->db->commit();
            return $ventaId;

        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
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