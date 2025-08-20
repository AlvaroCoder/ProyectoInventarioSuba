<?php 

class Conexion {
    private static $instance = null;
    private $pdo;
    
    private function __contruct(){
        $config = require_once '../../config/database.php';

        try {
            $dsn = "mysql:host={$config['localhost']};dbname={$config['inventario_db']};charset={$config['db_charset']}";
            $this->pdo = new PDO($dsn, $config['root'], $config['root123456']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $err) {
            die("Error de conexion : ".$err->getMessage());
        }
    }

        // Devuelve la instancia única de la conexión
        public static function getInstance() {
            if (self::$instance === null) {
                self::$instance = new Conexion();
            }
            return self::$instance;
        }
    
        // Devuelve el objeto PDO
        public function getConnection() {
            return $this->pdo;
        }
}

?>