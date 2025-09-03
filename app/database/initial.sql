CREATE DATABASE IF NOT EXISTS inventario_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE inventario_db;

-- Tabla de Usuarios (para login y roles)
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin','cajero','supervisor') DEFAULT 'cajero',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla Categorías
CREATE TABLE categoria (
    idCategoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255)
);

-- Tabla Presentaciones
CREATE TABLE presentacion (
    idPresentacion INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255)
);

-- Tabla Productos (con FK hacia categoría y presentación)
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT,
    cantidad INT DEFAULT 0,
    precio DECIMAL(10,2) NOT NULL,
    idCategoria INT,
    idPresentacion INT,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idCategoria) REFERENCES categoria(idCategoria) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (idPresentacion) REFERENCES presentacion(idPresentacion) ON DELETE SET NULL ON UPDATE CASCADE
);

-- Tabla Caja (movimientos de ingresos/egresos)
CREATE TABLE caja (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo ENUM('ingreso','egreso') NOT NULL,
    monto DECIMAL(10,2) NOT NULL,
    descripcion TEXT,
    usuario_id INT,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL ON UPDATE CASCADE
);