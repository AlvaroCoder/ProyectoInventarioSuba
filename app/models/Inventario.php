<?php
require_once __DIR__ . "/Conexion.php";

class Inventario {
    private $db;

    public function __construct() {
        $this->db = Conexion::getInstance()->getConnection();
    }

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

    public function get10FirstProducts(){
        $sql = "SELECT p.id, p.nombre, p.descripcion, p.cantidad, p.precio,
                       c.nombre AS categoria, m.nombre AS marca, pr.nombre AS presentacion
                FROM productos p
                LEFT JOIN categoria c ON p.idCategoria = c.idCategoria
                LEFT JOIN marca m ON p.idMarca = m.idMarca
                LEFT JOIN presentacion pr ON p.idPresentacion = pr.idPresentacion
                ORDER BY p.id ASC LIMIT 10";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id) {
        $sql = "SELECT p.id, p.nombre, p.descripcion, p.cantidad, p.precio,
                       c.nombre AS categoria, m.nombre AS marca, pr.nombre AS presentacion
                FROM productos p
                LEFT JOIN categoria c ON p.idCategoria = c.idCategoria
                LEFT JOIN marca m ON p.idMarca = m.idMarca
                LEFT JOIN presentacion pr ON p.idPresentacion = pr.idPresentacion
                WHERE p.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCountProducts(){
        $sql = "SELECT COUNT(id) AS total FROM productos";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getSumProducts(){
        $sql = "SELECT SUM(precio * cantidad) AS precioTotal FROM productos";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCountActiveProducts(){
        $sql = "SELECT COUNT(id) AS productosActivos FROM productos WHERE cantidad > 20";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCountInactiveProducts(){
        $sql = "SELECT COUNT(id) AS productosInactivos FROM productos WHERE cantidad <= 20";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCategorias(){
        $sql = "SELECT * FROM categoria";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPresentaciones(){
        $sql = "SELECT * FROM presentacion";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMarcas(){
        $sql = "SELECT * FROM marca";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($nombre, $cantidad, $precio, $idCategoria, $idMarca, $idPresentacion) {
        $sql = "INSERT INTO productos (nombre, cantidad, precio, idCategoria, idMarca, idPresentacion) 
                VALUES (:nombre, :cantidad, :precio, :idCategoria, :idMarca, :idPresentacion)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nombre' => $nombre,
            ':cantidad' => $cantidad,
            ':precio' => $precio,
            ':idCategoria' => $idCategoria,
            ':idMarca' => $idMarca,
            ':idPresentacion' => $idPresentacion,
        ]);
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

    public function updateStock($id, $cantidadVendida) {
        $sql = "UPDATE productos SET cantidad = cantidad - :cantidadVendida WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":cantidadVendida", $cantidadVendida);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function getFilteredProducts($nombre = '', $idCategoria = null, $idMarca = null, $idPresentacion = null) {
        $sql = "SELECT p.id, p.nombre, p.descripcion, p.cantidad, p.precio,
                       c.nombre AS categoria, m.nombre AS marca, pr.nombre AS presentacion
                FROM productos p
                LEFT JOIN categoria c ON p.idCategoria = c.idCategoria
                LEFT JOIN marca m ON p.idMarca = m.idMarca
                LEFT JOIN presentacion pr ON p.idPresentacion = pr.idPresentacion
                WHERE 1=1";
    
        $params = [];
    
        if (!empty($nombre)) {
            $sql .= " AND p.nombre LIKE :nombre";
            $params[':nombre'] = '%' . $nombre . '%';
        }
    
        if (!empty($idCategoria)) {
            $sql .= " AND p.idCategoria = :idCategoria";
            $params[':idCategoria'] = $idCategoria;
        }
    
        if (!empty($idMarca)) {
            $sql .= " AND p.idMarca = :idMarca";
            $params[':idMarca'] = $idMarca;
        }
    
        if (!empty($idPresentacion)) {
            $sql .= " AND p.idPresentacion = :idPresentacion";
            $params[':idPresentacion'] = $idPresentacion;
        }
    
        $sql .= " ORDER BY p.nombre ASC";
    
        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>