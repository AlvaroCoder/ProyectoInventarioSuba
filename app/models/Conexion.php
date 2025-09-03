<?php
class Conexion {
    private static $instance = null;
    private $connection;

    private function __construct() {
        try {
            $this->connection = new PDO("mysql:host=localhost;dbname=inventario_db;charset=utf8", "root", "root123456");
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Conexion();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
?>