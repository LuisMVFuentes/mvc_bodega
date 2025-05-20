-- Crear base de datos
CREATE DATABASE IF NOT EXISTS inventario_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE inventario_app;

-- Tabla: productos
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categoria VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    cantidad_existente INT NOT NULL DEFAULT 0
);

-- Tabla: ingresos
CREATE TABLE ingresos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT NOT NULL,
    cantidad_ingresada INT NOT NULL,
    fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE
);

-- Tabla: clientes
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    direccion TEXT
);

-- Tabla: boletas
CREATE TABLE boletas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero_boleta VARCHAR(20) NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    vendedor VARCHAR(100) NOT NULL,
    cliente_id INT,
    tipo_pago ENUM('efectivo', 'transferencia', 'yape') NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    pagado BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE SET NULL
);

-- Tabla: detalles_boleta
CREATE TABLE detalles_boleta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    boleta_id INT NOT NULL,
    producto_id INT NOT NULL,
    descripcion TEXT NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    cantidad INT NOT NULL,
    importe DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (boleta_id) REFERENCES boletas(id) ON DELETE CASCADE,
    FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE
);

-- Tabla: logs
CREATE TABLE logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    descripcion TEXT NOT NULL,
    referencia VARCHAR(50)
);
