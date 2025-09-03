<?php
require_once __DIR__ . "/Conexion.php";

class Inventario {
    private $db;

    public function __construct() {
        $this->db = Conexion::getInstance()->getConnection();
    }

    // Obtener todos los productos
    public function getAllProducts() {
        $sql = "SELECT p.id, p.nombre, p.descripcion, p.cantidad, p.precio,
                       c.nombre AS categoria, m.nombre AS marca, pr.nombre AS presentacion
                FROM productos p
                LEFT JOIN categoria c ON p.idCategoria = c.idCategoria
                LEFT JOIN marca m ON p.idMarca = m.idMarca
                LEFT JOIN presentacion pr ON p.idPresentacion = pr.idPresentacion
                ORDER BY p.nombre ASC";
    
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Insertar un producto
    public function insert($nombre, $cantidad, $precio) {
        $stmt = $this->db->prepare("INSERT INTO productos (nombre, cantidad, precio) VALUES (:nombre, :cantidad, :precio)");
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":cantidad", $cantidad);
        $stmt->bindParam(":precio", $precio);
        return $stmt->execute();
    }

    public function delete($id){
        $stmt = $this->db->prepare("DELETE FROM productos WHERE id = :id");
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function update($id, $nombre, $descripcion, $cantidad, $precio, $idCategoria, $idMarca, $idPresentacion) {
        $sql = "UPDATE productos
                SET nombre = :nombre,
                    descripcion = :descripcion,
                    cantidad = :cantidad,
                    precio = :precio,
                    idCategoria = :idCategoria,
                    idMarca = :idMarca,
                    idPresentacion = :idPresentacion
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":descripcion", $descripcion);
        $stmt->bindParam(":cantidad", $cantidad);
        $stmt->bindParam(":precio", $precio);
        $stmt->bindParam(":idCategoria", $idCategoria);
        $stmt->bindParam(":idMarca", $idMarca);
        $stmt->bindParam(":idPresentacion", $idPresentacion);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

}

?>