<?php
require_once "Conexion.php";

class Inventario {
    private $db;

    public function __construct() {
        $this->db = Conexion::getInstance()->getConnection();
    }

    // Obtener todos los productos
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM productos ORDER BY nombre ASC");
        return $stmt->fetchAll();
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

    public function update($id){
        
    }


}

?>