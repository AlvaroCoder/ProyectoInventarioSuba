
CREATE TABLE marca (
    idMarca INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion VARCHAR(100)
);


ALTER TABLE productos
ADD idMarca INT,
ADD CONSTRAINT fk_productos_marca FOREIGN KEY (idMarca) REFERENCES marca(idMarca);

