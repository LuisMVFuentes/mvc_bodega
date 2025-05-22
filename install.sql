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


-- Insertar productos
INSERT INTO productos (categoria, descripcion, precio, cantidad_existente) VALUES
('Bebidas', 'Coca-Cola 1.5L', 4.50, 30),
('Snacks', 'Papas Lays 150g', 3.00, 50),
('Limpieza', 'Detergente Ariel 1kg', 8.90, 20),
('Lácteos', 'Leche Gloria 1L', 3.20, 40);

-- Insertar ingresos
INSERT INTO ingresos (producto_id, cantidad_ingresada, fecha) VALUES
(1, 30, '2025-05-10 08:00:00'),
(2, 50, '2025-05-11 09:30:00'),
(3, 20, '2025-05-12 10:15:00'),
(4, 40, '2025-05-13 11:00:00');

-- Insertar clientes
INSERT INTO clientes (nombre, telefono, direccion) VALUES
('Inés Quispe', '987654321', 'Av. Primavera 123'),
('Carlos Rojas', '912345678', NULL),
('Lucía Fernández', '956789012', 'Calle Los Robles 45');

-- Insertar boletas
INSERT INTO boletas (numero_boleta, fecha, hora, vendedor, cliente_id, tipo_pago, total, pagado) VALUES
('B0010', '2025-05-14', '19:00:00', 'Juan Pérez', 1, 'yape', 10.50, FALSE),
('B0011', '2025-05-13', '07:00:00', 'Ana Gómez', NULL, 'efectivo', 26.80, TRUE),
('B0012', '2025-05-17', '19:00:00', 'Mario Ruiz', 2, 'transferencia', 6.40, TRUE);

-- Insertar detalles_boleta
INSERT INTO detalles_boleta (boleta_id, producto_id, descripcion, precio_unitario, cantidad, importe) VALUES
(1, 1, 'Coca-Cola 1.5L', 4.50, 1, 4.50),
(1, 2, 'Papas Lays 150g', 3.00, 2, 6.00),
(2, 3, 'Detergente Ariel 1kg', 8.90, 3, 26.70),
(3, 4, 'Leche Gloria 1L', 3.20, 2, 6.40);

-- Insertar logs
INSERT INTO logs (fecha, descripcion, referencia) VALUES
('2025-05-14 19:00:00', 'Se vendió, detalle en la boleta #B0010', 'B0010'),
('2025-05-13 07:00:00', 'Se ingresó mercadería, detalle en la boleta #B0011', 'B0011'),
('2025-05-17 19:00:00', 'El producto "4" se quedó sin stock', 'P004'),
('2025-06-15 19:00:00', 'No se pagó la boleta #B0010. Sra Inés', 'B0010');
