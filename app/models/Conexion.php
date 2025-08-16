<?php 

class Conexion {
    private static $instance = null;
    private $pdo;
    
    private function __contruct(){
        $config = require_once '../../config/database.php';

        try {
            $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset={$config['db_charset']}";
            $this->pdo = new PDO($dsn, $config['db_user'], $config['db_pass']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Errores con excepciones
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Fetch como array asociativo
        } catch (PDOException $err) {
            die("Error de conexion : ".$err->getMessage());
        }
    }
}

?>